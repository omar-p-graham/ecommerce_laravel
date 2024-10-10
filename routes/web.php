<?php

use App\Helpers\CartManagement;
use App\Livewire\Account;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\SignUp;
use App\Livewire\Cart;
use App\Livewire\Categories;
use App\Livewire\Checkout;
use App\Livewire\CheckoutCancel;
use App\Livewire\CheckoutSuccess;
use App\Livewire\HomePage;
use App\Livewire\OrderDetails;
use App\Livewire\Orders;
use App\Livewire\ProductDetails;
use App\Livewire\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/categories', Categories::class);
Route::get('/products', Products::class);
Route::get('/product/{slug}', ProductDetails::class);
Route::get('/my-cart', Cart::class);


Route::middleware('guest')->group(function (){
    Route::get('/login', Login::class)->name('login');
    Route::get('/sign-up', SignUp::class);
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function (){
    Route::get('/my-orders', Orders::class);
    Route::get('/my-order/{order_id}', OrderDetails::class)->name('order-view');
    Route::get('/checkout', Checkout::class);
    Route::get('/checkout-success', CheckoutSuccess::class)->name('order-success');
    Route::get('/checkout-cancel', CheckoutCancel::class)->name('order-cancel');
    Route::get('/profile',Account::class);
    Route::get('logout',function(){
        auth()->logout();
        CartManagement::clearCookie();
        return redirect('/');
    });
});
