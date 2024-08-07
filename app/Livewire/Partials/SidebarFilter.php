<?php

namespace App\Livewire\Partials;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;

class SidebarFilter extends Component
{
    public function render()
    {
        return view('livewire.partials.sidebar-filter',[
            'brands' => Brand::where('is_active',1)->get(['id','name','slug']),
            'categories' => Category::where('is_active',1)->get(['id','name','slug']),
        ]);
    }
}
