<div>
    <b class="pb-3 d-block">{{ $label }}</b>
    @forelse($values as $value => $title)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="{{ $value }}" name="{{ $name }}" id="{{ $name.'_'.$loop->iteration }}" {{ $affected ? ($affected == $value ? 'checked' : '') : ($loop->first ? 'checked':'') }}>
            <label class="form-check-label" for="{{ $name.'_'.$loop->iteration }}">
                {{ $title }}
            </label>
        </div>
    @empty
        {{ __('aboleon.framework::ui.no_data_provided') }}
    @endforelse
</div>