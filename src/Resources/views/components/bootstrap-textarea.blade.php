@if ($label)
    <label for="description" class="form-label">
        {{ $label }}
    </label>
@endif
<textarea name="{{ $name }}"
          class="form-control {{ is_array($className) ? explode(' ', $className) : $className }}"
          id="{{ $name }}"
          {!! !empty($height) ? 'style="height:'.$height.'px"' : '' !!}>{!! $value !!}</textarea>
