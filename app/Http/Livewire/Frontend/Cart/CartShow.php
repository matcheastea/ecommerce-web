<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    public $qrContent = null;
    public $showQr = false;
    public $qrUrl;


    public function checkout(){
        return redirect()->route('checkout.preview');
    }

    public function decrementQuantity(int $cartId){
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData){
            $cartData->decrement('quantity');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Quantity Updated',
                'type' => 'success',
                'status' => 200
            ]);
        }else{
             $this->dispatchBrowserEvent('message',[
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }   

    public function incrementQuantity(int $cartId){
         $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
                if($cartData->product->quantity > $cartData->quantity)
                {
                    $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
                
        }else{
             $this->dispatchBrowserEvent('message',[
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
    }   

    public function removeCartItem(int $cartId){
       $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id',$cartId)->first();
       if($cartRemoveData){
            $cartRemoveData->delete();
             $this->emit('cartAddedUpdated');
                    $this->dispatchBrowserEvent('message', [
                    'text' => 'Cart Item Removed',
                    'type' => 'success',
                    'status' => 200
                    ]);

       }else{
            $this->emit('cartAddedUpdated');
                    $this->dispatchBrowserEvent('message', [
                    'text' => 'Something Went Wrong',
                    'type' => 'error',
                    'status' => 500
                    ]);
       }
    }

    public function render()
    {
        $this->cart = Cart::with('product.productImages', 'product.category')
            ->where('user_id', auth()->id())
            ->get()
            ->groupBy('product_id')
            ->map(function ($items) {
                $first = $items->first();
                $first->quantity = $items->sum('quantity'); // total quantity untuk produk yang sama
                return $first;
            });

        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }

}
