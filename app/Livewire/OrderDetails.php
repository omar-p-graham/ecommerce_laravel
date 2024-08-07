<?php

namespace App\Livewire;

use Livewire\Component;

class OrderDetails extends Component
{
    public function render()
    {
        return view('livewire.order-details')
        ->title('Order Details: Flex E-Store');
    }
}
