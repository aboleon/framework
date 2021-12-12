<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class LanguageTabs extends Component
{
    public function __construct(
        public string $id
    )
    {}

    public function render(): Renderable
    {
        return view('aboleon.framework::components.language-tabs');
    }
}
