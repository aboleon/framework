<?php

namespace Aboleon\Framework\Facades;

use Illuminate\Support\Facades\Facade;

class ResponseRenderers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aboleon_response_renderers';
    }
}