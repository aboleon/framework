<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class BootstrapTextarea extends Component
{
    public function __construct(
        public string $name,
        public string $label = '',
        public string|null $value,
        public string|array $className = '',
        public string $height='')
    {
    }

    public function render(): Renderable
    {
        return view('aboleon.framework::components.bootstrap-textarea');
    }
}
