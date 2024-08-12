<?php

namespace App\Livewire;

use Livewire\Component;

class CheckoutCancel extends Component
{
    public function render()
    {
        return view('livewire.checkout-cancel')->title('Checkout Canceled: Flex E-Store');
    }
}
