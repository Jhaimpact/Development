<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LiItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public  $component;
    public function __construct($component)
    {
        $this->component = json_decode($component);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.li-item');
    }
}