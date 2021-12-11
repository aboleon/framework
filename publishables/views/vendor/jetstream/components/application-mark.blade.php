@if(is_file(public_path('media/logo.png')))
    <img src="{{ asset('media/logo.png') }}" alt="{{ config('app.name') }}">
@endif
