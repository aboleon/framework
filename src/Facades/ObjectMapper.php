<?php

namespace Aboleon\Framework\Facades;

use Illuminate\Support\Facades\Facade;

class ObjectMapper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aboleon_object_mapper';
    }
}