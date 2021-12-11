var uploadImage = function() {
    $('button.image-uploader').off().on('click', function(e) {
        e.preventDefault();
        //$('tbody.files').html('');

        var templateContainer = $('#image-uploader-template #imp').length > 0 ? $('#image-uploader-template') : $('.bloc-uploader').has('#imp');

        var uploadTemplate = templateContainer.html(),
        uploadBloc = $(this).parents('.uploadable');
        $('.uploadable .params').addClass('hidden');
        uploadBloc.find('.params').toggleClass('hidden');
        templateContainer.html('');
        $('.image-uploader').show();
        uploadBloc.find('.bloc-uploader').html(uploadTemplate).end().find('.image-uploader').hide();
        initImageUpload(uploadBloc);
    });
},
initImageUpload = function(uploadBloc) {
    var fileuploadForm = uploadBloc.find('form.fileupload')
    fileuploadForm.bind('fileuploadadd', function (e, data) {
        $('#fileupload table').fadeIn();
    }).fileupload({
        url: ajax_url(),
        dataType: 'json',
        context: fileuploadForm[0],
        type:'POST',
        done: function (e, data) {
            $('.progress').hide();
        },
        success: function(data) {
            console.log(data);
            var v ='';
            if (data.hasOwnProperty('errors')) {
                notificator(data.errors, 'danger', $('#imp .messages'));
            } else {
                var uploaded_file = data.uploaded,
                target = fileuploadForm.parents('.uploadable'),
                uploadTemplate = target.find('.bloc-uploader');
                $('tbody.files').delay(500).fadeOut(function() {
                    $(this).html('').show();
                    $('#image-uploader-template').html(uploadTemplate.html());
                    uploadTemplate.html('');
                    unlinkable();
                    target.find('.image-uploader').show();
                    uploadBloc.find('.params').toggleClass('hidden');
                });

                var v = ('<tr class="unlinkable uploaded-image">');
                v = v.concat('<td><a id="image-'+uploaded_file.id+'" target="_blank" href="'+uploaded_file.url+'"><img src="'+uploaded_file.thumbnail+'" alt=""/></a></td>');
                        //v = v.concat('<td>'+uploaded_file.name+'</td>');
                        v = v.concat('<td>'+$('#translation_scope_' + uploaded_file.uploaded.scope).text()+'</td>');
                        v = v.concat('<td><button class="btn btn-sm btn-danger unlink" data-object="products/AppsImages" data-id="'+uploaded_file.uploaded.filename+'"><i class="fa fa-remove"></i></button></td>');
                        v = v.concat('</tr>');
                        target.find('.uploaded > table').append(v);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    $('.messages').html('<div class="alert alert-danger">Une erreur est survenu lors du téléchargement de votre fichier</div>');
                },
                always: function(e,data) {
                    console.log(data);
                    $('.progress').hide();
                },
                start: function(e,data) {
                    $('#imp .messages').html('');
                    $('.progress').show();
                },
                acceptFileTypes: new RegExp('(\.|\/)('+ fileuploadForm.parents('.uploadable').attr('data-acceptable')+')$', 'i'),
                maxFileSize: 100000000,
                //maxNumberOfFiles: 1,
                autoUpload : true,
                messages: {
                    maxNumberOfFiles: 'Vous pouvez télécharger 1 seul fichier',
                    acceptFileTypes: 'Type de fichier non autorisé',
                    maxFileSize: 'Le fichier est trop volumineux (limite 10MB)'
                }
            });


    fileuploadForm.bind('fileuploadsubmit', function (e, data) {
        var uploadable = fileuploadForm.parents('.uploadable'),  params = uploadable.find('.params'),
        uploadable_label = params.find('input[name=uploadable_label]').val();
        data.formData = [];
        data.formData.push(
            { name: '_token', value: token() },
            { name: 'object', value: 'products/AppsImages' },
            { name: 'case', value: 'upload' },
            { name: 'appHash', value: $('#app_hash').val()},
            { name: 'uploadable_label', value: uploadable_label},
            { name: 'scope', value: params.find('input[name='+uploadable_label+'_scope]:checked').val()},
            { name: 'must_be', value: uploadable.attr('data-must-be') ? uploadable.attr('data-must-be') : 0},
            { name: 'min_height', value: uploadable.attr('data-min-height') ? uploadable.attr('data-min-height') : 0},
            { name: 'min_width', value: uploadable.attr('data-min-width') ? uploadable.attr('data-min-width') : 0},
            { name: 'resizable', value: uploadable.attr('resizable') ? 1 : 0}
            );
                console.log(data.formData);// return false;
            }).bind('fileuploadstop', function (e) {
            //$('#buttons-bottom .ajax').trigger('click');
        });
        }

        uploadImage();



        function setAppId(result) {
            $('#app_id').val(result.app_id);
        }

        if($('span.selfie.full input').is(':checked')) {
            $('span.selfie:not(.full) input').prop('disabled', true);
        }
        $('span.selfie input').click(function() { console.log($(this).is(':checked'));
            if ($(this).val() == 'full' && $(this).is(':checked')) {
                $('.selfie input').not($(this)).prop('disabled', true);
            } else {
                $('.selfie input').prop('disabled', false);
            }
        });
