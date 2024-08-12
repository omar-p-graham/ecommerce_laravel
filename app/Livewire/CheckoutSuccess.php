<?php

namespace App\Livewire;

use App\Models\Order;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Url;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutSuccess extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        $latestOrder = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first(); // get the latest order 'with' the address relationship

        if ($this->session_id) {
            Stripe::setApiKey(env('STRIPE_KEY'));
            $session_info = Session::retrieve($this->session_id);

            if ($session_info->payment_status=='paid' && $session_info->status=='complete') {
                $latestOrder->payment_status = 'paid';
                $latestOrder->save();
                Mail::to(request()->user())->send(new OrderPlaced($latestOrder));
            }else {
                $latestOrder->payment_status = 'failed';
                $latestOrder->save();
                return redirect()->route('order-cancel');
            }
        }

        return view('livewire.checkout-success',[
            'order' => $latestOrder
        ])->title('Checkout Success: Flex E-Store');;
    }
}
