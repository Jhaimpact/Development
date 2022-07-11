<?php

namespace App\View\Components;

use Illuminate\View\Component;

class generateHeader extends Component
{

    public $createbutton;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($createbutton = 1)
    {
        //
        $this->createbutton = $createbutton;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generate-header');
    }
}