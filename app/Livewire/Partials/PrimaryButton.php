<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class PrimaryButton extends Component
{
    public $content;

    public function mount($content){
        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.partials.primary-button',['content' => $this->content]);
    }
}
