<?php

namespace App\Http\Livewire\Frontend\Cart;

use Carbon\Carbon;
use App\Models\Cart;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Transaction;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    public $qrUrl;

    public function checkout(){

         $orderId = Str::uuid(); // ID unik, bisa diganti dengan sistem lain
         $username = auth()->user()->name;

         $cartItems = Cart::with('product.category')
         ->where('user_id', auth()->id())
         ->get();

    foreach ($cartItems as $item) {
        $product = $item->product;
        $quantity = $item->quantity;
        $price = $product->price;
        $totalPrice = $price * $quantity;
        Transaction::create([
            'order_id' => $orderId,
            'username' => $username,
            'product_name' => $item->product->name,
            'product_category' => $item->product->category_id,
            'quantity' => $quantity,
            'total' => $totalPrice,
            'transaction_datetime' => Carbon::now(),
        ]);
    }

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
