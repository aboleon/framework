<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class Notice extends Component
{
    public function __construct(
        public string $message,
        public string $type='info'
    ){}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.notice');
    }
}
