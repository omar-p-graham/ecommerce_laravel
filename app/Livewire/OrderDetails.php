<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Url;
use Livewire\Component;

class OrderDetails extends Component
{
    #[Url]
    public $order_id;

    public function render()
    {
        return view('livewire.order-details',[
            'order' => Order::with('user')->with('items')->with('address')->where('id',$this->order_id)->where('user_id',auth()->user()->id)->firstOrFail()
        ])
        ->title('Order Details: Flex E-Store');
    }
}
