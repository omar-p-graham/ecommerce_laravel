<?php

namespace App\Helpers;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement{
    // add product to cart
    static public function addProductToCart($product_id,$quantity=1){
        $cartItems = self::getCartItemsFromCookie();
        $existingItem = null;

        foreach($cartItems as $key => $item){ // check all items in the cart
            if($item['product_id']==$product_id){ // if the item is already in the cart
                $existingItem = $key; // extract the item key from the cart
                break;
            }
        }

        if($existingItem !== null){
            $cartItems[$existingItem]['quantity'] += $quantity; // increment the quantity of the item once it is already in the cart
            $cartItems[$existingItem]['total_amount'] = $cartItems[$existingItem]['unit_amount'] * $cartItems[$existingItem]['quantity']; // calculate the total price for the item
            $cartItems[$existingItem]['total_discount'] = ($cartItems[$existingItem]['unit_amount'] * ($cartItems[$existingItem]['discount'])) * $cartItems[$existingItem]['quantity']; // calculate the total discount for the item
        }else{
            $product = Product::where('id',$product_id)->first(['id','name','slug','price','images','on_sale','sale_discount']);
            if($product){
                $discount = number_format($product->price * ($product->sale_discount/100),2);
                $cartItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => $product->images[0],
                    'unit_amount' => $product->price,
                    'quantity' => $quantity,
                    'discount' => $discount,
                    'total_amount' => $product->price * $quantity,
                    'total_discount' => $discount * $quantity
                ];
            }
        }

        self::addCartToCookie($cartItems);
        return count($cartItems);
    }

    // remove product from cart
    static public function removeProductFromCart($product_id){
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if($item['product_id']==$product_id){
                unset($cartItems[$key]);
            }
        }

        self::addCartToCookie($cartItems);
        return $cartItems;
    }

    // add products to cookies
    static public function addCartToCookie($cartItems){
        Cookie::queue('cartItems', json_encode($cartItems), 60*24*7);
    }

    // get all products from cookie
    static public function getCartItemsFromCookie(){
        $cartItems = json_decode(Cookie::get('cartItems'),true);
        if(!$cartItems){
            $cartItems = [];
        }
        return $cartItems;
    }

    //clear cookie
    static public function clearCookie(){
        Cookie::queue(Cookie::forget('cartItems'));
    }

    // increment product quantity
    static public function incrementItemQuantity($product_id){
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if($item['product_id'] == $product_id){
                $cartItems[$key]['quantity']++;
                $cartItems[$key]['total_amount'] = $cartItems[$key]['unit_amount'] * $cartItems[$key]['quantity'];
                $cartItems[$key]['total_discount'] = ($cartItems[$key]['discount']) * $cartItems[$key]['quantity'];
            }
        }

        self::addCartToCookie($cartItems);
        return $cartItems;
    }

    // decrement product quantity
    static public function decrementItemQuantity($product_id){
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if($item['product_id'] == $product_id){
                if($cartItems[$key]['quantity'] > 1){
                    $cartItems[$key]['quantity']--;
                    $cartItems[$key]['total_amount'] = $cartItems[$key]['unit_amount'] * $cartItems[$key]['quantity'];
                    $cartItems[$key]['total_discount'] = ($cartItems[$key]['discount']) * $cartItems[$key]['quantity'];
                }else{
                    self::removeProductFromCart($product_id);
                }
            }
        }

        self::addCartToCookie($cartItems);
        return $cartItems;
    }

    // calculate grand total
    static public function calculateOrderSummary($cartItems){
        $cost = array_sum(array_column($cartItems, 'total_amount'));
        $total_discount = array_sum(array_column($cartItems, 'total_discount'));
       /* $tax = $cost * .013;
        $shipping = 0;

        if($cost>0 && $cost<=100){
            $shipping = 10;
        }elseif ($cost>100 && $cost<300) {
            $shipping = 7;
        }*/

        return [
            'cost' => $cost,
            /*'tax' => $tax,
            'shipping' => $shipping,*/
            'total_discount' => $total_discount,
            'grandTotal' => $cost - $total_discount
        ];
    }
}