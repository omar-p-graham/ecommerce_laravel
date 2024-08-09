<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $cartItemsCount = 0;

    #[On('cart_count')]
    public function cart_count($totalProducts){
        $this->cartItemsCount = $totalProducts;
    }

    public function mount(){
        $this->cartItemsCount = count(CartManagement::getCartItemsFromCookie());
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
