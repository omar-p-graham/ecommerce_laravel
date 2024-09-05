<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\URL;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    protected $products;
    public $sortBy;

    #[URL]
    public $filterCategories = []; 
    #[URL]
    public $filterBrands = [];
    #[URL]
    public $filterOnSale = [];
    #[URL]
    public $filterIsFeatured = [];
    #[URL]
    public $filterMinPrice = 0;
    #[URL]
    public $filterMaxPrice = 0;

    public function filter_products(){
        $this->products = Product::query()->where('is_active',1);

        if(!empty($this->filterCategories)){$this->products->whereIn('category_id',$this->filterCategories);} //apply categories filter
        if(!empty($this->filterBrands)){$this->products->whereIn('brand_id',$this->filterBrands);} //apply brands filter
        if(!empty($this->filterOnSale)){$this->products->where('on_sale',$this->filterOnSale);} //apply sale filter
        if(!empty($this->filterIsFeatured)){$this->products->where('is_featured',$this->filterIsFeatured);} //apply featured filter
        if(!empty($this->filterMinPrice) || !empty($this->filterMaxPrice)){ //apply price range filter
            if(!empty($this->filterMinPrice) && empty($this->filterMaxPrice)){
                $this->products->where('price','>=',$this->filterMinPrice);
            }else if(empty($this->filterMinPrice) && !empty($this->filterMaxPrice)){
                $this->products->where('price','<=',$this->filterMaxPrice);
            }else{
                $this->products->whereBetween('price',[$this->filterMinPrice,$this->filterMaxPrice]);
            }
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

    public function render()
    {
        $this->filter_products();

        return view('livewire.products',[
            'products' => $this->products->paginate(25),
            'brands' => Brand::where('is_active',1)->get(['id','name','slug']),
            'categories' => Category::where('is_active',1)->get(['id','name','slug']),
        ])
        ->title('Shop: Flex E-Store');
    }
}
