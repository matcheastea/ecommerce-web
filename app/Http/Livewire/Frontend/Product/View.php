<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
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

    public function addToCart(int $productId)
    {
        if(Auth::check())
        {
            // dd($productId);
            if($this->product->where('id', $productId)->where('status', '0')->exists())
            {
                if($this->product->quantity > 0)
                {
                     if($this->product->quantity > $this->quantityCount)
                {
                    // insert into cart
                    Cart::create([
                        'user_id' => auth()->user()->id,
                        'product_id' => $productId,
                        'quantity' => $this->quantityCount
                    ]);

                    $this->emit('cartAddedUpdated');
                    $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Added to Cart',
                    'type' => 'success',
                    'status' => 200
                    ]);
                }
                else
                {
                     $this->dispatchBrowserEvent('message', [
                    'text' => 'Only '.$this->product->quantity .'Quantity Available',
                    'type' => 'warning',
                    'status' => 401
                    ]);
                }
                }
                else
                {
                     $this->dispatchBrowserEvent('message', [
                    'text' => 'Out of Stock',
                    'type' => 'warning',
                    'status' => 401
                    ]);
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                'text' => 'Product Does not exists',
                'type' => 'warning',
                'status' => 401
                ]);
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
            'text' => 'Please login to add to cart',
            'type' => 'info',
            'status' => 401
            ]);
        }
    }

   
    public function mount($category, $product) {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
