<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class PrimaryLinkButton extends Component
{
    public $content;
    public $url;

    public function mount($content,$url){
        $this->content = $content;
        $this->url = $url;
    }
    public function render()
    {
        return view('livewire.partials.primary-link-button',[
            'content' => $this->content,
            'url' => $this->url
        ]);
    }
}
