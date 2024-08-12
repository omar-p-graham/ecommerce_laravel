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
            $cartItems[$existingItem]['totalAmount'] = $cartItems[$existingItem]['unit_amount'] * $cartItems[$existingItem]['quantity']; // calculate the total price for the item
        }else{
            $product = Product::where('id',$product_id)->first(['id','name','slug','price','images']);
            if($product){
                $cartItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => $product->images[0],
                    'unit_amount' => $product->price,
                    'quantity' => $quantity,
                    'totalAmount' => $product->price * $quantity
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
                $cartItems[$key]['totalAmount'] = $cartItems[$key]['unit_amount'] * $cartItems[$key]['quantity'];
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
                    $cartItems[$key]['totalAmount'] = $cartItems[$key]['unit_amount'] * $cartItems[$key]['quantity'];

                }else{
                    self::removeProductFromCart($product_id);
                }
            }
        }

        self::addCartToCookie($cartItems);
        return $cartItems;
    }

    // calculate grand total
    static public function calculateGrandTotal($cartItems){
        return array_sum(array_column($cartItems, 'totalAmount'));
    }
}