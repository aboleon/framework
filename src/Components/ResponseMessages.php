<?php

namespace Aboleon\Framework\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;

class ResponseMessages extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function render(): Renderable
    {
        return view('aboleon.framework::components.response-messages');
    }
}
