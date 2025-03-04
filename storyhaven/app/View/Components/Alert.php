<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type; // Tipo de alerta (success, error, warning, info)
    public $message; // Mensaje a mostrar

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @param string $message
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
