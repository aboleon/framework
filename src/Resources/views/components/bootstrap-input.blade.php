@if ($label)
    <label for="{{ str_replace(['][','[',']'],['_','_',''],$name) }}" class="form-label">{{ $label }}</label>
@endif
<input type="{{ $type ?? 'text' }}"
       name="{{ $name }}"
       class="form-control {{ is_array($className) ? explode(' ', $className) : $className }}"
       id="{{ str_replace(['][','[',']'],['_','_',''],$name) }}"
       value="{{ $value }}"
       @if(isset($placeholder))
       placeholder="{{ $placeholder }}"
        @endif>
