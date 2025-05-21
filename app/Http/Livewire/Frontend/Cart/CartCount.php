<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount = 0;

    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    public function checkCartCount(){

        if (Auth::check()) {
        $this->cartCount = Cart::where('user_id', auth()->id())->count();
    } else {
        $this->cartCount = 0;
    }
    }

    public function render()
    {
        $this->checkCartCount();

    return view('livewire.frontend.cart.cart-count', [
        'cartCount' => $this->cartCount,
    ]);
    }
}
