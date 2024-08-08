<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    
    protected $products;

    #[On('filter_products')]
    public function filter_products($filterCategories,$filterBrands,$filterOnSale,$filterIsFeatured){
        $this->products = Product::query()->where('is_active',1);

        if(!empty($filterCategories)){$this->products->whereIn('category_id',$filterCategories);} //apply categories filter
        if(!empty($filterBrands)){$this->products->whereIn('brand_id',$filterBrands);} //apply brands filter
        if(!empty($filterOnSale)){$this->products->where('on_sale',$filterOnSale);} //apply sale filter
        if(!empty($filterIsFeatured)){$this->products->where('is_featured',$filterIsFeatured);} //apply featured filter
    }

    /*public function mount()
    {
        $this->products = Product::query()->where('is_active',1);
    }*/

    public function render()
    {
        if(empty($this->products)){
            $this->products = Product::query()->where('is_active',1);
        }
        return view('livewire.products',[
            'products' => $this->products->paginate(25),
            'brands' => Brand::where('is_active',1)->get(['id','name','slug']),
            'categories' => Category::where('is_active',1)->get(['id','name','slug']),
        ])
        ->title('Shop: Flex E-Store');
    }
}
