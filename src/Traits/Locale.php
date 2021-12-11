<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;

trait Locale
{

    public function locale()
    {
        if (request()->filled('lg') && in_array(request()->lg, config('aboleon_framework.locales'))) {
            return request()->lg;
        }
        return app()->getLocale();
    }

    public function locales()
    {
        return config('aboleon_framework.locales');
    }

    public function activeLocales()
    {
        return config('aboleon_framework.active_locales');
    }

    public function isMultilang(): bool
    {
        return count($this->activeLocales()) > 1;
    }
}
/*
 * $h = '<x-front-layout>';
        $h .= '@if ($config)';
        $h .= '{{-- Page type: ' . $config->type . ' --}}';
        $h .= '<article class="{{ $config->type }}">';

        $h .= '@foreach ($config->config[\'elements\'] as $key => $section)';
        $h .= '<section class="{{ $section[\'classes\'] ?? \'\' }}">';
        foreach ($config->config['elements'] as $key => $section) {
            $h .= '{{-- Section: ' . $section['title'] . ' --}}';
        }
        $h .= '@if (array_key_exists(\'elements\', $section))';
        $h .= '@foreach($section[\'elements\'] as $subkey => $element)';
        $h .= '@php';
        $h .= '$value = $content ? current(array_filter($content, function($item) use($subkey) { return ($item[\'node_id\'] == $subkey); }))[\'content\'] : null';
        $h .= '$tag = array_key_exists(\'tag\', $element) ? $element[\'tag\'] : \'div\'';
        $h .= '@endphp';

        $h .= '{{ \'<\'.$tag.\' class="\'.($element[\'classes\'] ?? \'\').\'">\'. $value .\'</\'.$tag.\'>\' }}';

        $h .= '@endforeach';
        $h .= '@endif';
        $h .= '</section>';
        $h .= '@endforeach';
        $h .= '@endif';
        $h .= '</x-front-layout>';

        return $h;
 * */