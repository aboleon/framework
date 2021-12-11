@push('css')
<link rel="stylesheet" href="{!! asset('vendor/flatpickr/flatpickr.min.css') !!}"/>
@endpush
@push('js')
<script src="{!! asset('vendor/flatpickr/flatpickr.js') !!}"></script>
<script src="{!! asset('vendor/flatpickr/locale/'. app()->getLocale().'.js') !!}"></script>
<script>
    function setDatepickers() {
        if ($('.datepicker').length > 0) {
            $('.datepicker').each(function () {
                var config = {};
                config.dateFormat = "d/m/Y";
                config.time_24hr = true;
                config.locale = "fr";

                var custom_config = $(this).attr('data-config');

                if (custom_config != undefined && custom_config.length) {
                    var custom_config = custom_config.split(',');
                    for (i = 0; i < custom_config.length; ++i) {
                        var values = custom_config[i].split('='),
                            setValue;
                        switch (values[1]) {
                            case 'true':
                            case '1':
                                setValue = true;
                                break;
                            case 'false':
                            case '0':
                                setValue = false;
                                break;
                            default:
                                setValue = values[1];
                        }
                        config[values[0]] = setValue;
                    }
                }
                console.log($(this).hasClass('flatpickr-input'));
                if (!$(this).hasClass('flatpickr-input')) {

                    $(this).flatpickr(config);
                }
            });
        }
    }

    $(function () {
        setDatepickers();
        $("#clear_dates").click(function (e) {
            e.preventDefault();
            $('.datepicker').flatpickr().clear();
        });
    });

</script>

@endpush
