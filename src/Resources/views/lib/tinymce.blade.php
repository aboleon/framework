@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.1/tinymce.min.js"></script>

<script id="tinymce_settings" data-colors="{!! config('piblisher.text_color_map') !!}" src="{!! asset((isset($data) && is_file(public_path('aboleon/framework/js/tinymce/'.$data->type.'.js')) ? 'aboleon/framework/js/tinymce/'.$data->type : 'aboleon/framework/js/tinymce/default_settings').'.js') !!}"></script>

<script>
    tinymce.init(settings);
    $(function() {
        if ($('textarea.simplified').length) {
            var url = "{!! asset('aboleon/framework/js/tinymce/simplified.js') !!}";
            $.when($.getScript(url)).then(function() {
                tinymce.init(intro_settings);
            });
        }
    });
</script>
@endpush
