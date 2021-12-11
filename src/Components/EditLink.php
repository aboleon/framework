<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class EditLink extends Component
{
    public function __construct(public string $route) {}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.edit-link');
    }
}
