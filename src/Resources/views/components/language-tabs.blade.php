@php
$locales = config('translatable.locales');
@endphp
@if(count($locales)>1)
    <ul class="nav nav-tabs language-tabs">
        @foreach($locales as $k=>$v)
            <li class="nav-item" role="presentation">
                <button class="nav-link d-flex {!! $v == app()->getLocale() ? 'active': null !!}" id="tab_{{ $id }}_{{ $v  }}" data-bs-toggle="tab" data-bs-target="#tabcontent_{{ $id }}_{{$v}}" type="button" role="tab" aria-controls="tabcontent_{{ $id }}_{{$v}}" aria-selected="true">
                    <img src="{!! asset('vendor/flags/4x3/'.$v.'.svg') !!}" alt="{!! trans('aboleon.framework::lang.'.$v.'.label') !!}" width="20" style="margin: 4px 8px 0 0;"/>
                    {!! trans('aboleon.framework::lang.'.$v.'.label') !!}
                </button>
            </li>
        @endforeach
    </ul>
@endif