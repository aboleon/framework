<?php

declare(strict_types = 1);

namespace Aboleon\Framework\Models;

use Cache;
use Illuminate\Support\{Arr, Str};
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    public static function customLink(string $link, string $titre="Il est ou ton titre ?", string $icon='connectdevelop', string $url_matcher=''): string {
        return '<li class="customLink'. ($url_matcher && stristr($_SERVER['REQUEST_URI'], $url_matcher) ? ' active' : null) .'"><a href="'.url($link).'"><i class="menu-icon fas fa-'.$icon.'"></i> '.$titre.'</a></li>';
    }

    public static function listOfType(string $type, string $titre, $icon='list-alt'): string
    {

        return '<li class="listable" data-id="'.$type.'"><a href="'.url('panel/Publisher/pages/listOfType/'.$type).'"><i class="menu-icon fas fa-'.$icon.'"></i> '.$titre.'</a></li>';
    }

    public static function objectLink(string $titre, $object, $icon='list-alt', $method='index', $param=null) {
        return '<li class="listable" data-id="'.$object.'"><a href="'.url('panel/Publisher/'.$object.'/'.$method . ($param ? '/'.$param : null)).'"><i class="menu-icon fas fa-'.$icon.'"></i> '.$titre.'</a></li>';
    }

    public static function getItem(array $nav, string $type)
    {
        return current(array_filter($nav, function($item) use($type) {
            return $item['type'] == $type;
        }));
    }

    public static function link(array $nav, string $type, string $title=null, string $class=null) : string
    {
        $item = current(array_filter($nav, function($item) use($type) {
            return $item['type'] == $type;
        }));

        if ($item) {
            return '<a href="'.$item['url'].'"'.($class ? 'class="'.$class.'"' : '').'>'. ($title ?: $item['title']).'</a>';
        }

        return '';
    }

    public function remove()
    {
        self::find($this->object_id)->delete();
        Cache::forget('nav');
        $this->session_message(trans('publisher::publisher.ui.nav_removed'));
        return redirect()->back();
    }

}
