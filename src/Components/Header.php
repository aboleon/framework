<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $title = '')
    {
    }

    public function render(): Renderable
    {
        return view('aboleon.framework::components.header');
    }
}
