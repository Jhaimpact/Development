<?php

namespace App\View\Components;

use Illuminate\View\Component;

class generateButton extends Component
{
    public $id ;
    public $iname;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id ,$iname = "this" )
    {
        $this->id =  $id;
        $this->iname = $iname;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generate-button');
    }
}