<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LivewireInline extends Component
{
    public function render()
    {
        return <<<'blade'
            <div>
               <p>This is my Inline component
            </div>
        blade;
    }
}
