<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h4>My Cart</h4>
            <hr>

                <link rel="stylesheet" href="{{asset('asset/css/custom.css')}}">

    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse($cart as $cartItem)

                        @if($cartItem->product)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-5 my-auto">
                                    <a href="{{ url('collection/'.$cartItem->product->category->id.'/'.$cartItem->product->id)}}">
                                        <label class="product-name">
                                            @if($cartItem->product->productImages)
                                                <img src="{{ asset($cartItem->product->productImages[0]->image) }}" 
                                                style="width: 50px; height: 50px" alt="">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif

                                            {{$cartItem->product->name}}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">Rp {{$cartItem->product->price}}</label>
                                    @php $totalPrice += $cartItem->product->price*$cartItem->quantity @endphp
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{$cartItem->id}})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{ $cartItem->quantity}}" class="input-quantity" />
                                            <button type="button" wire:loading.attr="dissable" wire:click="incrementQuantity({{$cartItem->id}})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="total">Rp {{$cartItem->product->price * $cartItem->quantity}}</label>
                                </div>

                                <div class="col-md-1 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{ $cartItem->id }})"class="btn btn-danger btn-sm">
                                            <span wire:loading.remove wire:target="removeCartItem({{ $cartItem->id }})">
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                            <div>No Cart Item</div>
                        @endforelse           
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>
                        Get the best deals & offfers <a href="{{url('/collections')}}">shop now</a>
                    </h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total:
                            <span class="float-end">Rp {{ $totalPrice }}</span>
                        </h4>
                        <hr>
                       <button wire:click="checkout" class="btn btn-warning mt-3 float-end">Checkout</button>
                     @if($qrUrl)
                        <div class="text-center mt-4">
                            <h5>Scan QR Order</h5>
                            <img src="{{ $qrUrl }}" alt="QR Code" class="border rounded p-2">
                            <p class="text-danger">Show this QR code to canteen staff</p>
                        </div>
                    @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
