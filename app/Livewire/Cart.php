<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $orderSummary;

    public function mount(){
        $this->cartItems = CartManagement::getCartItemsFromCookie();
        $this->orderSummary = CartManagement::calculateOrderSummary($this->cartItems);
    }

    public function render()
    {
        return view('livewire.cart',[
            'items' => $this->cartItems
        ])
        ->title('Cart: Flex E-Store');
    }

    public function removeItemFromCart($productID){
        $this->cartItems = CartManagement::removeProductFromCart($productID);
        $this->orderSummary = CartManagement::calculateOrderSummary($this->cartItems);
        $this->dispatch('cart_count',totalProducts:count($this->cartItems))->to(Navbar::class);
    }

    public function increaseItemQuantity($productID){
        $this->cartItems = CartManagement::incrementItemQuantity($productID);
        $this->orderSummary = CartManagement::calculateOrderSummary($this->cartItems);
    }

    public function decreaseItemQuantity($productID){
        $this->cartItems = CartManagement::decrementItemQuantity($productID);
        $this->orderSummary = CartManagement::calculateOrderSummary($this->cartItems);
    }
}
