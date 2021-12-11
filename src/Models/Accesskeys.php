<?php

declare(strict_types = 1);

namespace Aboleon\Framework\Models;

use Aboleon\Framework\Repositories\Tables;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Accesskeys extends Model
{

    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = Tables::fetch('accesskeys');
        $this->timestamps = false;
    }

    public function accessible(): MorphTo
    {
        return $this->morphTo();
    }

    public static function generateAccessKey(): string
    {
        $key = Str::random(8);

        if(static::where('access_key', $key)->exists()) {
            static::generateAccessKey();
        }
        return $key;
    }

}
