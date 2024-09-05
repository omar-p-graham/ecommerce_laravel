<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductDetails extends Component
{
    use LivewireAlert;
    public $slug;
    public $product;
    // public $productID;
    public $productquantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug',$this->slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.product-details',[
            'product' => $this->product,
            'related_products' => Product::where('category_id',$this->product->category_id)->whereNot('slug',$this->slug)->get()->shuffle()->splice(0,9)
        ])
        ->title('Product Details: Flex E-Store');
    }

    public function incrementQuantity(){
        $this->productquantity++;
    }

    public function decrementQuantity(){
        if($this->productquantity>1){
            $this->productquantity--;
        }
    }
    public function addToCart($productID){
        $totalProducts = CartManagement::addProductToCart($productID,$this->productquantity);
        $this->dispatch('cart_count',totalProducts:$totalProducts)->to(Navbar::class);

        $this->alert('success', 'Item Successfully Added', [
            'position' => 'top-start',
            'timer' => '1500',
            'toast' => true,
        ]);
    }
}
