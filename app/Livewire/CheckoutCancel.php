<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\URL;

class CheckoutCancel extends Component
{
    #[URL]
    public $order_id;

    public function render()
    {
        DB::table('orders')->where('id', $this->order_id)->update(['status' => 'cancelled', 'payment_status' => 'failed']);
        return view('livewire.checkout-cancel')->title('Checkout Canceled: Flex E-Store');
    }
}
