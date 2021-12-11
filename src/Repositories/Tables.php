<?php

namespace Aboleon\Framework\Repositories;

class Tables {

    private static array $tables = [
        'accesskeys' => 'aboleon_accesskeys'

    ];

    public static function fetch(string $table)
    {
        return self::$tables[$table];
    }

}