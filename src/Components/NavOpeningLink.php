<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class NavOpeningLink extends Component
{
    public function __construct(
        public string $title,
        public string $icon = ''
    ) {}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.nav-opening-link');
    }
}
