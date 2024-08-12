<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id',auth()->user()->id)->latest()->paginate(10);

        return view('livewire.orders',[
            'orders' => $orders
        ])
        ->title('Orders: Flex E-Store');
    }
}
