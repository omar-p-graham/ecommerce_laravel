<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', true)->limit(8)->get();
        $featureds = Product::whereAll(['is_active','is_featured'],true)->limit(8)->get();
        return view('livewire.home-page',[
            'brands' => $brands,
            'featureds' => $featureds
        ])
        ->title('Home: Flex E-Store');
    }
}
