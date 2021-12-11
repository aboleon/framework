@if(count($locales)>1)
    <ul class="nav nav-tabs language-tabs">
        @foreach($locales as $k=>$v)
            <li class="{!! $v == app()->getLocale() ? 'active': null !!}">
                <a href="#lang{{ $v }}" data-toggle="tab" aria-expanded="true" data-lang="{{ $v }}" data-label="{{ trans('core::lang.'.$v.'.label') }}">
                    <img src="{!! asset('vendor/flags/4x3/'.$v.'.svg') !!}" alt="" width="20" style="margin:-3px 5px 0 0;"/>
                    {!! trans('core::lang.'.$v.'.label') !!}
                </a>
            </li>
        @endforeach
    </ul>
@endif
@push('js')
    <script>
      $(function () {
        $('.language-tabs a').click(function () {
          $('.language-tabs li').removeClass('active');
          $(this).closest('li').addClass('active');
        });
      });
    </script>
@endpush
