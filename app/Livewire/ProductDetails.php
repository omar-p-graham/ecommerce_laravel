<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.product-details',[
            'product' => Product::where('slug',$this->slug)->firstOrFail()
        ])
        ->title('Product Details: Flex E-Store');
    }
}
