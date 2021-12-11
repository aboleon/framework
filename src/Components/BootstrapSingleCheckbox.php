<?php

namespace Aboleon\Framework\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BootstrapSingleCheckbox extends Component
{
    public function __construct(
        public string          $label,
        public string          $name,
        public int|string|null $value = '',
        public bool $affected = false,
        public string          $class = ''
    )
    {
    }

    public function render()
    {
        return view('aboleon.framework::components.bootstrap-single-checkbox');
    }
}
