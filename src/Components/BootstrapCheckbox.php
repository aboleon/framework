<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BootstrapCheckbox extends Component
{
    public function __construct(
        public int | string | null $id,
        public string $label,
        public string $name,
        public Collection $affected,
        public string | null $forLabel ='',
        public string $class =''
    ) {}

    public function isSelected(): bool
    {
        return $this->affected->contains($this->id);
    }

    public function render(): Renderable
    {
        return view('aboleon.framework::components.bootstrap-checkbox');
    }
}
