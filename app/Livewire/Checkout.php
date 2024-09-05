<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use Stripe\Checkout\Session;
use Livewire\Component;
use Stripe\Stripe;

class Checkout extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;

    public function submitOrder(){
        // dd($this->first_name,$this->last_name,$this->phone,$this->street_address,$this->city,$this->state,$this->zip_code);
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|min:5|max:10',
        ]);

        $cartItems = CartManagement::getCartItemsFromCookie();
        $lineItems = [];

        foreach($cartItems as $item){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $item['price'] * 100, //The price has to be multiplied by 100 to remove any decimals so that it can be processed by STRIPE
                    'product_data' => [
                        'name' => $item['name'],
                    ]
                ],
                'quantity' => $item['quantity']
            ];
        };

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->cost = CartManagement::calculateOrderSummary($cartItems)['cost'];
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'usd';
        $order->shipping_amount = CartManagement::calculateOrderSummary($cartItems)['shipping'];
        $order->shipping_method = 'none';
        $order->tax = CartManagement::calculateOrderSummary($cartItems)['tax'];
        $order->notes = 'Order placed by '.auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        Stripe::setApiKey(env('STRIPE_KEY'));
        $sessionCheckout = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => auth()->user()->email,
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('order-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('order-cancel'),
        ]);

        $redirectUrl = $sessionCheckout->url;

        $order->save();
        $address->order_id = $order->id;
        $address->save();

        $order->items()->createMany($cartItems);
        CartManagement::clearCookie();
        return redirect($redirectUrl);
    }

    public function mount(){
        $cartItems = CartManagement::getCartItemsFromCookie();
        if(empty($cartItems)){
            return redirect('/products');
        }
    }

    public function render()
    {
        $items = CartManagement::getCartItemsFromCookie();
        $orderSummary = CartManagement::calculateOrderSummary($items);
        return view('livewire.checkout',[
            'items' => $items,
            'orderSummary' => $orderSummary
        ])
        ->title('Checkout: Flex E-Store');
    }
}
