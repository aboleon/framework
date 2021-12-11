<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;

use App\Exceptions\UnknownMethodCallException;

trait Uncallable
{
    public function __call($name, $arguments)
    {
        throw new UnknownMethodCallException($name, self::class);
    }
}
