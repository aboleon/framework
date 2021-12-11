<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BtnSave extends Component
{
    public string $label = '';

    public function __construct(string $label = '')
    {
        $this->label = $label ?: __('aboleon.framework::ui.buttons.save');
    }


    public function render(): Renderable
    {
        return view('aboleon.framework::components.btn-save');
    }
}
