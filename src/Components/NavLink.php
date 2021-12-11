<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class NavLink extends Component
{
    public function __construct(
        public string $route,
        public string $title,
        public string $icon = '',
        public string $target='_self'
    ) {}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.nav-link');
    }
}
