<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class DeleteLink extends Component
{
    public function __construct(
        public int|string $reference,
        public string     $route,
        public string     $question = '',
        public string     $title = '')
    {
        $this->question = $this->question ?: __('aboleon.framework::ui.should_i_delete_record');
        $this->title = $this->title ?: __('aboleon.framework::ui.deletion');
    }

    public function render(): Renderable
    {
        return view('aboleon.framework::components.delete-link')->with([
            'modal_id' => $this->reference
        ]);
    }
}
