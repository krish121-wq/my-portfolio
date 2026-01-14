@extends('../layouts.masterlayouts')
@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Cart</a>
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
                                <th scope="col" style="width: 40%;">Product</th>
                                <th scope="col" style="width: 15%;">Price</th>
                                <th scope="col" style="width: 20%;">Quantity</th>
                                <th scope="col" style="width: 15%;">Total</th>
                                <th scope="col" style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $grandTotal = 0; 
                            @endphp

                            @if($carts->count() > 0)
                                @foreach($carts as $item)
                                @php 
                                    $rowTotal = $item->product->price * $item->quantity;
                                    $grandTotal += $rowTotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('img/'.$item->product->image) }}" alt="" 
                                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; border: 1px solid #eee;">
                                            </div>
                                            <div class="media-body">
                                                <p style="font-weight: bold; color: #333; margin-bottom: 0;">{{ $item->product->name }}</p>
                                                <small class="text-muted">Cat: {{ $item->category_id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rs {{ number_format($item->product->price, 2) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
    <input type="number" 
           name="qty" 
           id="sst-{{ $item->id }}" 
           value="{{ $item->quantity }}" 
           title="Quantity:" 
           class="input-text qty qty-input" 
           data-id="{{ $item->product_id }}" 
           data-price="{{ $item->product->price }}"
           min="1">
</div>
                                    </td>
                                   <td>
    <h5 style="color: #ffba00;">Rs <span class="item-total">{{ number_format($rowTotal, 2) }}</span></h5>
</td>
                                    <td>
                                        <a href="{{ url('deletecarts/'.$item->product_id) }}" class="genric-btn danger-border circle small" onclick="return confirm('Are you sure?')">
                                            <i class="lnr lnr-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center" style="padding: 50px;">
                                        <h3>Your Cart is Empty</h3>
                                        <a href="/shop" class="primary-btn mt-3">Continue Shopping</a>
                                    </td>
                                </tr>
                            @endif

                            @if($carts->count() > 0)
                            <tr class="bottom_button">
                                <!-- <td>
                                    <a class="gray_btn" href="#">Update Cart</a>
                                </td> -->
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
    <h5 style="font-size: 18px; font-weight: bold;">Rs <span id="cart-subtotal">{{ number_format($grandTotal, 2) }}</span></h5>
</td>
                                <td></td>
                            </tr>
                            <tr class="out_button_area">
                                <td colspan="5">
                                    <div class="checkout_btn_inner d-flex align-items-center justify-content-end">
                                        <a class="gray_btn" href="/shop">Continue Shopping</a>
                                        <a class="primary-btn" href="#">Proceed to checkout</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Jab user quantity change karega
        $('.qty-input').on('change keyup', function() {
            var $el = $(this);
            var pid = $el.data('id');
            var price = parseFloat($el.data('price'));
            var qty = parseInt($el.val());

            // Quantity 1 se kam na ho
            if(qty < 1) { qty = 1; $el.val(1); }

            // 1. Row ka Total Update (Price * Qty)
            var itemTotal = price * qty;
            $el.closest('tr').find('.item-total').text(itemTotal.toFixed(2));

            // 2. Subtotal Update Loop
            var grandTotal = 0;
            $('.qty-input').each(function() {
                var p = parseFloat($(this).data('price'));
                var q = parseInt($(this).val());
                grandTotal += (p * q);
            });
            $('#cart-subtotal').text(grandTotal.toFixed(2));

            // 3. Server par data save karna (AJAX)
            $.ajax({
                url: "{{ route('cart.update.ajax') }}",
                method: "PATCH",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: pid,
                    quantity: qty
                },
                success: function(response) {
                    console.log('Cart updated');
                }
            });
        });
    });
</script>

    @endsection