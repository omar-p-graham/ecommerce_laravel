<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class PrimaryButton extends Component
{
    use LivewireAlert;
    public $content;
    public $productID;
    public $productquantity = 1;

    #[On('product-quantity')]
    public function productQuantity($quantity){
        $this->productquantity = $quantity;
    }

    public function mount($content,$productid=null){
        $this->content = $content;
        if($productid){$this->productID = $productid;}
    }

    public function render()
    {
        return view('livewire.partials.primary-button',['content' => $this->content]);
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
