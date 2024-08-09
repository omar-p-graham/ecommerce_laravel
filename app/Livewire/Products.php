<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    protected $products;
    public $sortBy;

    #[On('filter_products')]
    public function filter_products($filterCategories,$filterBrands,$filterOnSale,$filterIsFeatured){
        $this->products = Product::query()->where('is_active',1);

        if(!empty($filterCategories)){$this->products->whereIn('category_id',$filterCategories);} //apply categories filter
        if(!empty($filterBrands)){$this->products->whereIn('brand_id',$filterBrands);} //apply brands filter
        if(!empty($filterOnSale)){$this->products->where('on_sale',$filterOnSale);} //apply sale filter
        if(!empty($filterIsFeatured)){$this->products->where('is_featured',$filterIsFeatured);} //apply featured filter
    }

    public function addToCart($productID){
        $totalProducts = CartManagement::addProductToCart($productID);
        $this->dispatch('cart_count',totalProducts:$totalProducts)->to(Navbar::class);

        $this->alert('success', 'Item Successfully Added', [
            'position' => 'top-start',
            'timer' => '1500',
            'toast' => true,
        ]);
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

        if($this->sortBy=="relevance"){
            return;
        }elseif($this->sortBy=="latest"){
            $this->products->latest();
        }elseif($this->sortBy=="name_asc"){
            $this->products->orderBy('name');
        }elseif($this->sortBy=="name_asc"){
            $this->products->orderByDesc('name');
        }elseif($this->sortBy=="price_asc"){
            $this->products->orderBy('price');
        }elseif($this->sortBy=="price_asc"){
            $this->products->orderByDesc('price');
        }

        return view('livewire.products',[
            'products' => $this->products->paginate(25),
            'brands' => Brand::where('is_active',1)->get(['id','name','slug']),
            'categories' => Category::where('is_active',1)->get(['id','name','slug']),
        ])
        ->title('Shop: Flex E-Store');
    }
}
