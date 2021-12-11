<?php

namespace Aboleon\Framework\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Configurables extends Model
{

    protected $table = 'aboleon_framework_config';
    public $timestamps = false;

    public function __construct()
    {
        parent::__construct();
    }

    public static function recacheItems()
    {
        Cache::forget('aboleon.framework.configurables');
        Cache::rememberForever('aboleon.framework.configurables', function () {
            return Configurables::pluck('value', 'name')->toArray();
        });
        Configurables::selectedLangs();
    }

    public static function selectedLangs()
    {
        return Cache::rememberForever('aboleon.framework.active_langs', function () {
            return isset(cache('aboleon.framework.configurables')['select_langs']) ? unserialize(cache('aboleon.framework.configurables')['select_langs']) : config('config.locales');
        });
    }

    public function parseValue()
    {
        switch ($this->type) {
            case 'number':
                return ceil(floatval(request()->value) * 100);
            case 'custom':
                if (method_exists($this, 'parse_' . $this->name)) {
                    return $this->{'parse_' . $this->name}();
                }
                break;
            default:
                return request()->value;
        }
    }

    private function parse_select_langs()
    {
        Cache::forget('aboleon_framework.active_langs');
        if (request()->has('select_langs')) {
            return serialize(request()->select_langs);
        }
        return null;
    }
}
