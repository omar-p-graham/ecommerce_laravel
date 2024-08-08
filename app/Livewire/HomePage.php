<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', true)->get()->shuffle()->splice(0,8);
        $featureds = Product::whereAll(['is_active','is_featured'],true)->get()->shuffle()->splice(0,8);
        return view('livewire.home-page',[
            'brands' => $brands,
            'featureds' => $featureds
        ])
        ->title('Home: Flex E-Store');
    }
}
