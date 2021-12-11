var location_ajax_url = 'panel/Core/ajax';

function getDestination(setter, callback) {

    $(setter).keyup(function() {
    	console.log('getDestination Start');

        var my = $(this);
    	//alert(this.value);
    	var inputString = this.value;

    	if (inputString.length < 2) {
			// Hide the suggestion box.
			$('.suggestions' ).hide();
		} else {
            $.ajax({
                url: base_url(location_ajax_url),
                type: 'POST',
                //dataType : 'json',
                data :"&_token="+token()+"&object=locations&ajax_action=search&queryString="+inputString,
                success: function(result) {
                    console.log(result);
                    var resultList = $(my).parent('div').find('div.suggestions');

                    resultList.html(result);
                    resultList.show();

                    $('.suggestions button.addLoc').click(function(e) {
                        console.log('AddLoc Modal Triggered');
                        e.preventDefault();
                        $('#addLocNames').find('input:text').val(my.parent('div').find("input[name='location_name[]']").val());
                    });

                    $(my).parent('div').find('div.suggestions li').click(function() {

                        var location_id = $(this).attr('id').replace(/loc/g, ''),
                        location_name = $(this).text();
                        $(my).val(location_name);
                        $('#core-location_id').val(location_id);

                        console.log('Input Location Name is : ' + location_name);
                        console.log('Input Location Id is : ' + location_id);

                        resultList.hide();

                        if (callback) {
                            callback();
                        }
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                        //alert(' Error status : '+ xhr.status+ "\n Thrown Error : "+ thrownError +"\n Error : "+ xhr.responseText);
                        var result = ' Error status : '+ xhr.status+ ", Thrown Error : "+ thrownError +", Error : "+ xhr.responseText;
                        $('<div class="alert alert-danger" id="general_error" style="margin-top:14px;padding:8px 15px">'+result+'</div>')
                        .insertAfter('#program').fadeIn();
                    }
                });
        }
    });
}

getDestination("input[name=location]");

// Get predefined error messages
var errorCountry = $('#addLoc').find('.errorCountry').text();
var errorLocationType = $('#addLoc').find('.errorLocationType').text();
var errorInputs = $('#addLoc').find('.errorInputs').text();
var r = $('#addLocRegion');


// Get Regions for country
// ------------------------
$('#addLocCountry').find('select').on('change', function() {

    var country = $(this).val();
    if(!country || country < 1) {
        if(!r.hasClass('hidden')) {
            r.addClass('hidden');
        }
    } else {

        $.ajax({
            url: location_ajax_url,
            type: 'POST',
            dataType:'json',
            data: "_token="+token()+"&object=locations&ajax_action=SelectRegions&country="+country,
            success: function(result) {
                console.log(result);
                if(result.hasOwnProperty('error')) {
                    $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+result.error+'</div>');
                } else {
                    r.find('select').html(result.list);
                    r.removeClass('hidden');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var result = ' Error status : '+ xhr.status+ ", Thrown Error : "+ thrownError +", Error : "+ xhr.responseText;
                $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+result+'</div>');
            }
        });
    }
});


$('#addLoc i.fa').click(function() {
    var s = $(this);
    if (s.hasClass('fa-plus-circle')) {
        s.removeClass('fa-plus-circle').addClass('fa-minus-circle');
    } else {
        s.removeClass('fa-minus-circle').addClass('fa-plus-circle');
    }
    $('#'+s.attr('data-trigger')).toggleClass('hidden');
});

// Add country
// --------------------------------------
$('button.addMasterLoc').click(function(e) {

    e.preventDefault();
    $('#modalError').remove();

    console.log('Click on Add Master Loc');

    var errors = false,
    element = $(this).closest('div.dashedBloc'),
    masterType = $(this).attr('data-type'),
    reflector = $(this).attr('data-reflector'),
    inputs = element.find('input');

    inputs.each(function() {
        if(!$(this).val()) {
            errors = true;
        }
    });

    if (errors) {
        $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+errorInputs+'</div>');
        return false;
    }

    var data = inputs.serialize(), country = $('#addLocCountry select').val();
    console.log(country);
    if(masterType == 'region') {
        if(!country || country < 1) {
            $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+errorCountry+'</div>');
            return false;
        }
    }

    $.ajax({
        url: location_ajax_url,
        type: 'POST',
        dataType:'json',
        data: "&_token="+token()+"&object=locations&ajax_action=addMaster&masterType="+masterType+"&country="+country+"&"+data,
        success: function(result) {
            console.log(result);
            if(result.hasOwnProperty('error')) {
                $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+result.error+'</div>');
            } else {
                $(reflector).find('option:selected').prop('selected', false);
                $(reflector).append('<option selected="selected" value="'+result.loc_id+'">'+result.loc_name+'</option>');
                inputs.val('');
                element.addClass('hidden');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var result = ' Error status : '+ xhr.status+ ", Thrown Error : "+ thrownError +", Error : "+ xhr.responseText;
            $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+result+'</div>');
        }
    });

});

// Manage the behaviour of location types
// --------------------------------------
var locTypes = $('#addLoc :radio');
locTypes.prop('checked', false)
$(locTypes[0]).prop('checked',true);
locTypes.click(function() {
    var value = $(this).val();
    //console.log('Click on Location Type\nValue is ' + value);
    switch(value) {
        case 'country' :
        $('#addLocCountry, div.form-group.cp').hide();
        break;
        case 'region' :
        $('#core_cp').hide();
        $('#addLocCountry').show();
        break;
        default :
        $('#core_cp, #addLocCountry').show();
    }

});

// Record new location
// --------------------
$('#saveNewLoc').click(function() {

    console.log('Save Location clic');

    $('#modalError').remove();

    // Check if type is set
    if(($('#addLoc').find('input:radio:checked').length) < 1) {
        $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+errorLocationType+'</div>');
        console.log('errorLocationType');
        return false;
    }

    var errors = false,
    locType = $('input[name=type]:checked').val(),
    country = $('#core-select-country').val();

    $('#addLocNames input').each(function() {
        if(!$(this).val()) {
            errors = true;
        }
    });

    if (errors) {
        $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+errorInputs+'</div>');
        return false;
    }

    // If type is not country, check if country is set
    if(locType != 'country' && (!country || country < 1)) {
        $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+errorCountry+'</div>');
        return false;
    }

    var data = $('#addLoc').find('input, select').serialize(),
    container_id = $('div.suggestions').parents('div.element').attr('id');

    $.ajax({
        url: location_ajax_url,
        type: 'POST',
        dataType:'json',
        data : "&_token="+token()+"&object=locations&callback=false&ajax_action=addLocation&"+data,
        success: function(result) {

            console.log(result);

            if(result.hasOwnProperty('error')) {
                $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+result.error+'</div>');
            } else {

                $('#core-location_id').val(result.loc_id);
                $('#core-location_name').val(result.loc_name);

                $('#addLoc').find('input').not(':radio').val('').end().find('select option').removeAttr('selected');
                r.addClass('hidden');
                $('div.suggestions').hide();
                $('#addLoc').modal('hide');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('ERROR');
            var result = ' Error status : '+ xhr.status+ ", Thrown Error : "+ thrownError +", Error : "+ xhr.responseText;
            console.log(result);

            $('#addLoc').find('.modal-body').append('<div id="modalError" class="alert alert-danger">'+result+'</div>');
        }
    });

});
// end -----------
