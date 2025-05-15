<?php

namespace App\Http\Livewire\Frontend\Product;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $quantityCount = 1;

    public function incrementQuantity(){
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function addToCart(int $productId){
        if(Auth::check()){
            dd('am in');
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function mount($category, $product) {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
