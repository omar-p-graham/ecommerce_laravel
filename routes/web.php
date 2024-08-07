<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\SignUp;
use App\Livewire\Cart;
use App\Livewire\Categories;
use App\Livewire\Checkout;
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
Route::get('/my-orders', Orders::class);
Route::get('/my-order/{order}', OrderDetails::class);
Route::get('/checkout', Checkout::class);

Route::get('/login', Login::class);
Route::get('/sign-up', SignUp::class);
Route::get('/forgot-password', ForgotPassword::class);
Route::get('/reset-password', ResetPassword::class);
