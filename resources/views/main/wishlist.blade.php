@extends('layouts.masterlayouts')

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>My Wishlist</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Wishlist</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 15%">Image</th>
                                <th scope="col" style="width: 35%">Product Name</th>
                                <th scope="col" style="width: 15%">Price</th>
                                <th scope="col" style="width: 20%">Action</th>
                                <th scope="col" style="width: 15%">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($wishlists->count() > 0)
                                @foreach ($wishlists as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ asset('img/'.$item->product->image) }}" alt="" 
                                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; border: 1px solid #eee;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media-body">
                                                <h5 style="color: #222;">{{ $item->product->name }}</h5>
                                                <p style="font-size: 13px; color: #777;">Added on: {{ $item->created_at->format('d M, Y') }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 style="color: #ffba00;">Rs {{ number_format($item->product->price, 2) }}</h5>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="genric-btn primary circle small add-to-cart-btn"
   data-product-id="{{ $item->product->id }}" 
   data-price="{{ $item->product->price }}" 
   data-category-id="{{ $item->product->category_id }}"> Add to Cart
</a>
                                            <p id="message-{{ $item->product_id }}" style="color: green; font-size: 12px; display: none; margin-top: 5px;"></p>
                                        </td>
                                        <td>
                                            <form action="{{ route('deleteWishlist', $item->product_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="genric-btn danger-border circle small" onclick="return confirm('Are you sure?')">
                                                    <i class="lnr lnr-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center" style="padding: 60px;">
                                        <h3 style="color: #777;">Your Wishlist is Empty</h3>
                                        <a href="/shop" class="primary-btn mt-4">Start Shopping</a>
                                    </td>
                                </tr>
                            @endif

                            @if($wishlists->count() > 0)
                            <tr class="out_button_area">
                                <td colspan="5">
                                    <div class="checkout_btn_inner d-flex align-items-center justify-content-end">
                                        <a class="gray_btn" href="/shop">Continue Shopping</a>
                                        <a class="primary-btn" href="{{ route('carts') }}">View Cart</a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @endsection