<?php

namespace App\Helpers;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement{
    // add product to cart
    static public function addProductToCart($productID,$quantity=1){
        $cartItems = self::getCartItemsFromCookie();
        $existingItem = null;

        foreach($cartItems as $key => $item){ // check all items in the cart
            if($item['productID']==$productID){ // if the item is already in the cart
                $existingItem = $key; // extract the item key from the cart
                break;
            }
        }

        if($existingItem !== null){
            $cartItems[$existingItem]['quantity'] += $quantity; // increment the quantity of the item once it is already in the cart
            $cartItems[$existingItem]['totalAmount'] = $cartItems[$existingItem]['price'] * $cartItems[$existingItem]['quantity']; // calculate the total price for the item
        }else{
            $product = Product::where('id',$productID)->first(['id','name','slug','price','images']);
            if($product){
                $cartItems[] = [
                    'productID' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => $product->images[0],
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'totalAmount' => $product->price * $quantity
                ];
            }
        }

        self::addCartToCookie($cartItems);
        return count($cartItems);
    }

    // remove product from cart
    static public function removeProductFromCart($productID){
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if($item['productID']==$productID){
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
    static public function incrementItemQuantity($productID){
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if($item['productID'] == $productID){
                $cartItems[$key]['quantity']++;
                $cartItems[$key]['totalAmount'] = $cartItems[$key]['price'] * $cartItems[$key]['quantity'];
            }
        }

        self::addCartToCookie($cartItems);
        return $cartItems;
    }

    // decrement product quantity
    static public function decrementItemQuantity($productID){
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if($item['productID'] == $productID){
                if($cartItems[$key]['quantity'] > 1){
                    $cartItems[$key]['quantity']--;
                    $cartItems[$key]['totalAmount'] = $cartItems[$key]['price'] * $cartItems[$key]['quantity'];

                }else{
                    self::removeProductFromCart($productID);
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