<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $slug;
    public $product;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug',$this->slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.product-details',[
            'product' => $this->product,
            'related_products' => Product::where('category_id',$this->product->category_id)->whereNot('slug',$this->slug)->get()->shuffle()->splice(0,7)
        ])
        ->title('Product Details: Flex E-Store');
    }
}
