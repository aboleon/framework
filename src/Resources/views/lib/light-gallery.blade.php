@push('css')
    <link type="text/css" rel="stylesheet" href="{!! asset('vendor/Justified-Gallery/dist/css/justifiedGallery.min.css')
!!}"/>
    <link type="text/css" rel="stylesheet" href="{!! asset('vendor/lightGallery/dist/css/lightgallery.min.css') !!}"/>
@endpush
@push('js')
    <script src="{!! asset('vendor/Justified-Gallery/dist/js/jquery.justifiedGallery.min.js') !!}" defer></script>
    <script src="{!! asset('vendor/lightGallery/dist/js/lightgallery.min.js') !!}" defer></script>
    <script src="{!! asset('vendor/lightGallery/modules/lg-thumbnail.min.js') !!}" defer></script>
    <script src="{!! asset('vendor/lightGallery/modules/lg-fullscreen.min.js') !!}" defer></script>
    <script src="{!! asset($theme.'js/lg-settings.js') !!}" defer></script>
@endpush
