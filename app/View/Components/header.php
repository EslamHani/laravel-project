<?php

namespace App\View\Components;

use Illuminate\View\Component;

class header extends Component
{

    public $name;
    public $fruits;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $fruits)
    {
        $this->name = $name;
        $this->fruits = $fruits;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}
