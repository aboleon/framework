<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class DeleteLinkModal extends Component
{
    public function __construct(
        public int|string $reference,
        public string $route,
        public string $question,
        public string $title,
        public string $modalreference
    ) {
        $this->question = $this->question ?? __('crm.should_i_delete_record');
        $this->modalreference = $this->modalreference ?? 'myModal'.$this->reference;
        $this->title = $this->title ?? __('crm.deletion');
    }

    public function render(): Renderable
    {
        return view('aboleon.framework::components.delete-link-modal');
    }
}
