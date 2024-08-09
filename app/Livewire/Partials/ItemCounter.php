<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class ItemCounter extends Component
{
    public $quantity = 1;

    public function mount($quantity){
        $this->quantity = $quantity;
        $this->dispatchQuantity();
    }

    public function render()
    {
        return view('livewire.partials.item-counter');
    }

    public function incrementQuantity(){
        $this->quantity++;
        $this->dispatchQuantity();
    }

    public function decrementQuantity(){
        if($this->quantity>1){
            $this->quantity--;
        }
        $this->dispatchQuantity();
    }

    public function dispatchQuantity(){
        $this->dispatch('product-quantity',quantity:$this->quantity)->to(PrimaryButton::class);
    }
}
