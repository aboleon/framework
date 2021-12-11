<?php
$langs = cache('aboleon_framework.active_langs') ?? config('aboleon_framework.active_locales');
$imploded = [];
?>
@foreach($langs as $value)
    @php
        $imploded[] = trans('aboleon.framework::lang.'.$value.'.label');
    @endphp
@endforeach
<strong>{{ implode(', ', $imploded) }}</strong>
