<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class BootstrapSelect extends Component
{
    public function __construct(
        public array $values,
        public string $name,
        public int|string|null $affected ='',
        public string $label = '')
    {}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.bootstrap-select');
    }
}
