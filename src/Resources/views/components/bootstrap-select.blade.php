@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif
<select id="{{ $name }}" name="{{ $name }}" class="form-control" title="{{ $label ?: $name }}">
    <option value="">---</option>
    @foreach($values as $key => $value)
        <option value="{{ $key }}"{{ $affected && $key == $affected ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
