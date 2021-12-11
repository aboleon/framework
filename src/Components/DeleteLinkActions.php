<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class DeleteLinkActions extends Component
{
    public function __construct(
        public string $modalreference,
        public string $title,
    ) {
        $this->title = $this->title ?? __('crm.deletion');
    }

    public function render(): Renderable
    {
        return view('aboleon.framework::components.delete-link-actions');
    }
}
