<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alertNotification extends Component
{
    public $alert_type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->alert_type = session('success') ? 'primary' : ((session('error') || (isset($errors) && $errors->any() )) ? 'danger' : '');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert-notification');
     }
}