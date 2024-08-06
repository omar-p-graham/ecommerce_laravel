<?php

namespace App\Livewire\Partials;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class MainHeading extends Component
{
    #[Reactive]
    public $heading;

    public function mount($heading){
        $this->heading = $heading;
    }
    public function render()
    {
        return view('livewire.partials.main-heading',['heading'=>$this->heading]);
    }
}
