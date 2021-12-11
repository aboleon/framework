<?php

namespace Aboleon\Framework\Components;

use Illuminate\View\Component;

class BootstrapInput extends Component
{

    public function __construct(
        public string $name,
        public int|string|null $value = '',
        public string $type = 'text',
        public string $placeholder = '',
        public string|null $label = '',
        public string|array $className = '')
    {
    }

    public function render()
    {
        return view('aboleon.framework::components.bootstrap-input');
    }
}
