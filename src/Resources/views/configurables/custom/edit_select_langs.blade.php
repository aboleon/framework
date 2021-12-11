@php
    $recorded = array_filter((array)unserialize($configurable->value));
@endphp

@foreach(config('aboleon_framework.locales') as $locale)
    <div class="form-check form-check-inline">
        <input class="form-check-input" id="select_lang_{{ $loop->iteration }}" type="checkbox" name="select_langs[]" value="{{ $locale }}" {{ in_array($locale, $recorded) ? 'checked' : '' }}>
        <label class="form-check-label" for="select_lang_{{ $loop->iteration }}">{{ trans('aboleon.framework::lang.'.$locale.'.label') }}</label>
    </div>
@endforeach
