<?php

namespace App\View\Components;

use Illuminate\View\Component;

use Illuminate\Support\Facades\Gate;

class tableHeader extends Component
{
    public $create_button;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($create_button)
    {
        $this->create_button = $create_button; 
        $this->auth = Gate::allows('create-auth');
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    { 
        return view('components.table-header');
    }
}