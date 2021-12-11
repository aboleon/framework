<div class="form-check {{ $class }}">
    <input class="form-check-input" type="checkbox" name="{{ $name }}" value="{{$id}}" id="{{ $forLabel ?? $label . $id }}" {{ $isSelected() ? ' checked' : '' }}/>
    @if ($label)
        <label class="form-check-label" for="{{ $forLabel ?? $label . $id }}">
            {{ $label }}
        </label>
    @endif
</div>
