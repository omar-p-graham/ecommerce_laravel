<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public function render()
    {
        $categories = Category::where('is_active',true)->get();
        return view('livewire.categories',[
            'categories' => $categories
        ])
        ->title('Categories: Flex E-Store');
    }
}
