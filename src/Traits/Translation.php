<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;
use Spatie\Translatable\HasTranslations;

trait Translation
{
    use HasTranslations;

    public function print()
    {

    }
    public function translation(string $key, string $locale): string|array
    {

        if (array_key_exists($key, $this->getTranslations())) {
            return $this->getTranslation($key,$locale);
        }
        return '';
    }

}