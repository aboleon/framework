$.fn.hasParent = function (e) {
  return !!$(this).parents(e).length;
};
var token = function () {
    return $('meta[name="csrf-token"]').attr('content');
  },
  dev = $('#dev_env').length,
  base_url = function (param) {
    param = param ? param : '';
    return $('base').attr('href') + param;
  },
  ajax_request_url = function () {
    return base_url() + 'ajax';
  },
  spinner = '<i class="core spinner fa fa-cog fa-spin fa-fw"></i>',
  timerDefault = function () {
    return 500;
  },
  setDelay = (function () {
    var timer = 0;
    return function (callback, ms) {
      clearTimeout(timer);
      timer = setTimeout(callback, ms);
    };
  })(),
  timer = timerDefault(),
  spinout = function () {
    setTimeout(function () {
      $('.spinner').fadeOut(function () {
        $(this).remove();
      });
    }, timer + timerDefault());
  },
  notificationQueue = function (messages) {
    return messages.find(' > div').length;
  },
  notificator_dismiss = function (messages) {
    var delay_sum = timer * (notificationQueue(messages) + 1),
      delays = delay_sum > 3000 ? delay_sum : 3000;
    setTimeout(function () {
      timer = timerDefault();
      messages.find('> div').each(function (index) {
        $(this).delay(timer * (index)).fadeOut(timer * (index + 1), function () {
          $(this).remove();
        });
      });
    }, delays);
  },
  notificator = function (status, data, messages) {
    if (dev) {
      console.log(messages, status);
    }
    messages.html('');
    if (status == 200) {
      $(data).each(function (index, message) {
        timer = timerDefault() * (notificationQueue(messages) + 1);
        $.each(message, function (key, value) {
          alertDispatcher(value, messages, key);
        });
      });
    } else if (status == 422) { // Laraval JSON Validator Messages
      if (data.responseJSON.hasOwnProperty('errors')) {
        $.each(data.responseJSON.errors, function (key, value) {
          alertDispatcher(value[0], messages, 'danger');
        });
      }
    } else if (status == 404 || status == 500 || status == 401) {
      alertDispatcher($('#js_' + status).text(), messages, 'danger');
    } else {
      if (data.hasOwnProperty('responseJSON')) {
        if (data.responseJSON.messages.length > 0) {
          $.each(data.responseJSON.messages, function (key, value) {
            $.each(value, function (message_key, message_text) {
              alertDispatcher(message_text, messages, message_key);
            });
          });
        }
      }
    }
    dismissable();
  },
  alertDispatcher = function (message, messages, messageType) {
    var alert = '<div style="display:none;" class="alert alert-dismissible alert-' + messageType + '">';
    alert = alert.concat('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
    alert = alert.concat(message + '</div>');
    messages.append(alert);
    messages.find('div:last').fadeIn(timer);
  },
  ajax = function (formData, selector) {
    // Le conteneur pour les réponses de la requête
    if (typeof selector == 'undefined') {
      var selector = $(this).closest('.form');
    }

    var ajax_url = ajax_request_url(),

      formElement = selector.closest('.form'),
      formTag = selector.closest('form');
    if (dev) {
      console.log(formElement);
    }
    if ((selector[0].tagName == 'FORM' && selector[0].action != '')) {
      ajax_url = selector[0].action;
      if (dev) {
        console.log('case 1');
      }
    } else if (selector[0].hasAttribute('data-url')) {
      ajax_url = base_url() + selector.attr('data-url');
      if (dev) {
        console.log('case 2');
      }
    } else if (formElement.length) {
      if (formElement[0].hasAttribute('data-url')) {
        ajax_url = base_url() + formElement.attr('data-url');
        if (dev) {
          console.log('case 3');
        }
      } else if (formElement[0].hasAttribute('action') && formElement[0].action != '') {
        ajax_url = formElement[0].action;
        if (dev) {
          console.log('case 4');
        }
      }
    } else if (formTag.length) {
      if (formTag[0].hasAttribute('data-ajax')) {
        ajax_url =formTag.attr('data-ajax');
      }
    }
    if (dev) {
      console.log('Ajax started on ' + ajax_url);
    }
    if (selector.find('.messages').length < 1) {
      if (dev) {
        console.log('I have appended messages');
      }
      selector.append('<div class="messages"></div>');
    }
    var messages = selector.find('.messages');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      url: ajax_url,
      type: 'POST',
      dataType: 'json',
    });
    if (dev) {
      console.log('Ajax started on ' + ajax_url);
    }
    // return false;
    // Le conteneur pour les réponses de la requête
    if (typeof selector == 'undefined') {
      var selector = $(this).closest('.form');
    }
    if (selector.find('.messages').length < 1) {
      if (dev) {
        console.log('I have appended messages');
      }
      selector.append('<div class="messages"></div>');
    }
    var messages = selector.find('.messages');
    messages.html('');
    if (dev) {
      console.log(selector);
      console.log(messages);
    }
    $.ajax({
      data: formData,
      done: function () {
        messages.html('');
      },
      success: function (result) {
        console.log(result);
        if (dev) {
          console.log(result);
        }
        if (result.hasOwnProperty('messages')) {
          notificator(200, result.messages, messages);
        }
        if (result.hasOwnProperty('redirect_to')) {
          setTimeout(function () {
            window.location = result.redirect_to;
          }, 991500);
        }
        var executable_callback = null;
        if (result.hasOwnProperty('input')) {
          if (result.input.hasOwnProperty('callback')) {
            executable_callback = result.input.callback;
          }
        }
        if (result.hasOwnProperty('callback')) {
          executable_callback = result.callback;
        }

        if (dev) {
          console.log('executable_callback', executable_callback, result);
        }
        if (executable_callback !== null) {
          var is_callback_object = executable_callback.split('.');
          callback = (is_callback_object.length > 1) ? is_callback_object[0] : executable_callback;
          var fn = window[callback];
          if (typeof fn === 'object') {
            if (is_callback_object.length < 3) { // var.method
              window[callback][is_callback_object[1]](result);
            } else { // var.var.method
              window[callback][is_callback_object[1]][is_callback_object[2]](result);
            }
          }
          if (typeof fn === 'function') {
            fn(result);
          }
        }
      },
      error: function (xhr) {
        if (dev) {
          console.log(xhr);
        }
        notificator(xhr.status, xhr, messages);
      },
    }).always(function () {
      spinout();
    });
  },
  slugify = function (text) {
    return text.toString().toLowerCase().replace(/\s+/g, '-').replace(/[^\u0100-\uFFFF\w\-]/g, '-').replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
  },
  guid = function (keylength = 9) {
    return Math.random().toString(36).substr(2, keylength);
  },
  access_key = function (keylength = 16) {
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000)
        .toString(keylength)
        .substring(1);
    }

    return s4() + s4() + s4() + s4() + s4() + s4() + s4() + s4() + s4() + s4();
  },
  unlinkable = function () {
    $('.unlink').off().on('click', function (e) {
      e.preventDefault();
      var formContainer = $(this).closest('.form'),
        textConfirm = formContainer.attr('data-unlink-confirm'),
        textUnlink = $(this).html();
      $(this).addClass('timeout').text(textConfirm);
      setTimeout(function () {
        if (dev) {
          console.log('Timeout is set');
        }
        $('.unlink.timeout').removeClass('timeout').html(textUnlink);
        unlinkable();
      }, 2000);
      $('.unlink.timeout').off().on('click', function (e) {
        e.preventDefault();
        var selector = $(this).closest('.unlinkable'),
          formData = 'object=' + formContainer.attr('data-object') + '&ajax_action=unlink&object_id=' + $(this).attr('data-id') + '&module=' + selector.attr('data-module') + '&identifier=' + $(this).attr('data-identifier');
        if (selector.hasClass('unsaved')) {
          selector.remove();
        } else {
          ajax(formData, formContainer);
          $(document).ajaxSuccess(function () {
            selector.remove();
          });
        }
      });
      return false;
    });
  },
  isUrlValid = function (userInput) {
    var regexQuery = '^(https://)?(www\\.)?([-a-z0-9]{1,63}\\.)*?[a-z0-9][-a-z0-9]{0,61}[a-z0-9]\\.[a-z]{2,6}(/[-\\w@\\+\\.~#\\?&/=%]*)?$';
    var url = new RegExp(regexQuery, 'i');
    return url.test(userInput);
  },
  dismissable = function () {
    $('.alert-dismissible button').off().on('click', function () {
      $(this).parent().remove();
    });
  };
currentDate = function () {
  var today = new Date(),
    dd = today.getDate(),
    mm = today.getMonth() + 1; //January is 0!,
  yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd;
  }
  if (mm < 10) {
    mm = '0' + mm;
  }
  return dd + '/' + mm + '/' + yyyy;
},
  // Téléchargement des images : annuler
  cancel = function () {
    $('#fileupload table').find('tbody').html('').end().hide();
    $('#imp .messages').html('');
  },
  ajaxable = function () {
    $('.ajaxable').off().on('click', function (e) {
      $('div.messages').remove();
      e.preventDefault();
      $('#uncachtableType').remove();
      $(this).append(spinner);
      $(this).find('i.spinner').fadeIn();
      if (typeof tinyMCE != 'undefined') {
        if (tinyMCE.editors.length > 0) {
          tinyMCE.triggerSave();
        }
      }
      var form = $(this).closest('.form'),
        ajaxableType = $(this).attr('type');
      if (typeof $(this).attr('data-object') != 'undefined' && form.find('input[name="object"]').length) {
        form.find('input[name="object"]').val($(this).attr('data-object'));
      }
      if (ajaxableType == 'button' || ajaxableType == 'submit') {
        form.append('<input id="uncachtableType" type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).val() + '"/>');
      }
      ajax(form.find('input, select, textarea').serialize(), form);
    });
  },
  forceValidFloat = function (n) {
    if (n.length == 0) return '';
    var valids = '-0123456789',
      hasDot = false,
      r = '',
      c;

    for (var i = 0; i < n.length; ++i) {
      c = n.charAt(i);
      if ((c == '.' || c == ',') && !hasDot) {
        r += (r.length == 0) ? '0.' : '.';
        hasDot = true;
      } else if (valids.indexOf(c) != -1) {
        r += c;
      }
    }

    // If you want to limit to just 2 decimals
    // var t = r;
    // return (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
    // https://stackoverflow.com/questions/46321683/javascript-restrict-input-once-2-decimal-places-have-been-reached

    return r;
  };
$(function () {
  ajaxable();
  unlinkable();
  $('input.forceValidFloat').off().on('keyup', function () {
    $(this).val(forceValidFloat($(this).val()));
  });
  $('.toggle-edit').click(function (e) {
    e.preventDefault();
    location.assign(base_url($(this).attr('data-content') + '/edit?object_id=' + ($(document).find('input[name=object_id]').val())));
  });
});
