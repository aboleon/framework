
    function initialize() {

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                      center: geolocation,
                      radius: position.coords.accuracy
                  });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }

        function setGoogleBar(element) {

            var placeSearch, autocomplete;
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };

            var user_lat = element.find('.wa_geo_lat').val();
            var user_lon = element.find('.wa_geo_lon').val();

            var base_lat = user_lat.length ? user_lat : 49.0442236;
            var base_lon = user_lon.length ? user_lon : -40.4197786;
            var base_zoom = user_lat.length ? 15 : 3;
            //(document.getElementById('autocomplete'))
            //console.log(document.getElementById('autocomplete'));
            console.log(element.find('.g_autocomplete')[0]);
            //return false;
            autocomplete = new google.maps.places.Autocomplete(element.find('.g_autocomplete')[0], {types: ['geocode']});
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();

                for (var component in componentForm) {
                    element.find('.'+component).val('').prop('disabled', false);
                    /* document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false; */
                }
                element.find('.country_code').val('').prop('disabled', false);
                //document.getElementById('country_code').disabled = false;

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        console.log(addressType, val);
                        var val = place.address_components[i][componentForm[addressType]];
                        //document.getElementById(addressType).value = val;
                        element.find('.'+addressType).val(val);
                    }
                    if (addressType == "country") {
                        element.find('.country_code').val(place.address_components[i].short_name);
                    }
                }
                element.find('.wa_geo_lat').val(place.geometry.location.lat());
                element.find('.wa_geo_lon').val(place.geometry.location.lng());
                //element.find('.wa_geo_loc').val(place.geometry.location.lng());

                var callback = element.parent().data('callback');
                if (callback != undefined) {
                 var fn = window[callback];
                 if(typeof fn === 'function') {
                    fn(element)
                }
            }

        });

        }
        console.log($('.gmapsbar').length);
        if ($('.gmapsbar').length) {
            $('.gmapsbar').each(function() {
                setGoogleBar($(this));
            });
        }
        $('form').submit(function() {
            if ($('.gmapsbar').length) {
                $('.gmapsbar').each(function() {
                    if ($.trim($(this).find(':text').val()) == '') {
                        $(this).find(':hidden').val('');
                    }
                });
            }
        });
    }
