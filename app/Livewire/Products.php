<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        $products = Product::paginate(25);
        return view('livewire.products',[
            'products' => $products
        ]);
    }
}
