<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class BootstrapRadio extends Component
{
    /**
     * BoostrapRadio constructor.
     * @param array $values
     * @param string $name
     * @param int|string|null $affected
     */
    public function __construct(
        public array $values,
        public string $name,
        public string $label,
        public int|string|null $affected)
    {}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.bootstrap-radio');
    }
}
