<?php

namespace App\Livewire\Partials;

use App\Livewire\Products;
use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;

class SidebarFilter extends Component
{
    #[Url]
    public $filterCategories = []; 
    #[Url]
    public $filterBrands = [];
    #[Url]
    public $filterOnSale = [];
    #[Url]
    public $filterIsFeatured = [];
    #[Url]
    public $filterMinPrice = 0;
    #[Url]
    public $filterMaxPrice = 0;

    /*public function mount()
    {
        $this->applyFilters();
    }*/

    public function render()
    {
        $this->applyFilters();

        return view('livewire.partials.sidebar-filter',[
            'brands' => Brand::where('is_active',1)->get(['id','name','slug']),
            'categories' => Category::where('is_active',1)->get(['id','name','slug']),
        ]);
    }

    /*public function updated()
    {
        $this->applyFilters();
    }*/

    public function applyFilters()
    {
        $this->dispatch('filter_products',filterCategories:$this->filterCategories,filterBrands:$this->filterBrands,filterOnSale:$this->filterOnSale,filterIsFeatured:$this->filterIsFeatured,filterMinPrice:$this->filterMinPrice,filterMaxPrice:$this->filterMaxPrice)->to(Products::class);
    }
}
