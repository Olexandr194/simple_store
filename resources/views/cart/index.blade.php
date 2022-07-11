@extends('layouts.main')

@section('title', 'Cart')
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
@endsection

@section('custom_js')
    <script>
        $(function () {
            $(document).on('click', '.quantity_inc', function (event) {
                event.preventDefault();
                let inc_value = $(this).closest('.cart_item').find('#quantity_input').val();
                let value = parseInt(inc_value);
                value = isNaN(value) ? 0 : value;
                if (value < 25) {
                    value++;
                    $(this).closest('.cart_item').find('#quantity_input').val(value);
                }
            });
            $(document).on('click', '.quantity_dec', function (event) {
                event.preventDefault();
                let dec_value = $(this).closest('.cart_item').find('#quantity_input').val();
                let value = parseInt(dec_value);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).closest('.cart_item').find('#quantity_input').val(value);
                }
            });
            $(document).on('click', '.delete-item', function (event) {
                event.preventDefault();
                let product_id = $(this).closest('.cart_item').find('.product_id').val();
                $.ajax({
                    url: "{{ route('main.cart.delete') }}",
                    type: "POST",
                    data: {
                        'product_id': product_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('.cart_info').html(data);

                    },
                    error: (data) => {
                        console.log(data)
                    }
                });
            });
            $(document).on('click', '.quantity_control', function (event) {
                event.preventDefault();
                let product_id = $(this).closest('.cart_item').find('.product_id').val();
                let product_qty = $(this).closest('.cart_item').find('#quantity_input').val();
                $.ajax({
                    url: "{{ route('main.cart.update') }}",
                    type: "POST",
                    data: {
                        'product_id': product_id,
                        'product_qty': product_qty,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('.cart_info').html(data);

                    },
                    error: (data) => {
                        console.log(data)
                    }
                });
            });
            $(document).on('click', '.clear_cart_button', function (event) {
                event.preventDefault();

               $.ajax({
                    url: "{{ route('main.cart.clear') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('.cart_info').html(data);
                    },
                    error: (data) => {
                        console.log(data)
                    }
                });
            });
            $(document).on('click', '.update_cart_button', function (event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('main.cart.updateCart') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        $('.cart_info').html(data);
                    },
                    error: (data) => {
                        console.log(data)
                    }
                });
            });
        });

    </script>
@endsection

@section('content')
    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url({{ asset('/images/1561183001_36.jpg') }})"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="{{ route('main.home') }}">Home</a></li>
                                        <li>Shopping Cart</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Info -->

    <div class="cart_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Column Titles -->
                    <div class="cart_info_columns clearfix">
                        <div class="cart_info_col cart_info_col_product">Product</div>
                        <div class="cart_info_col cart_info_col_price">Price</div>
                        <div class="cart_info_col cart_info_col_quantity">Quantity</div>
                        <div class="cart_info_col cart_info_col_total">Total</div>
                    </div>
                </div>
            </div>
            <div class="row cart_items_row">
                <div class="col">
                    <div class="ajax-delete">
                        @php $total_price =0; @endphp
                        @foreach($items as $item)
                            <!-- Cart Item -->
                            <div
                                class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                                <!-- Name -->

                                <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">

                                    <div class="cart_item_image">

                                        <div><img src="{{ url('storage/' . $item->products->image) }}" alt=""></div>
                                    </div>
                                    <div class="cart_item_name_container">
                                        <div class="cart_item_name"><a href="#">{{ $item->products->title }}</a></div>
                                        <div class="cart_item_edit">
                                            <button class="btn btn-danger delete-item">Remove Product</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Price -->
                                <div class="cart_item_price">${{$item->products->price}}</div>
                                <!-- Quantity -->
                                <div class="cart_item_quantity">
                                    <div class="product_quantity_container">
                                        <div class="product_quantity clearfix">
                                            <span>Qty</span>
                                            <input type="hidden" class="product_id" value="{{ $item->product_id }}">
                                            <input id="quantity_input" type="text" pattern="[0-9]*"
                                                   value="{{ $item->product_qty }}">
                                            <div class="quantity_buttons">
                                                <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                        class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                                <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                        class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Total -->
                                <div class="cart_item_total">${{ $item->product_qty * $item->products->price }}</div>
                            </div>
                            @php $total_price += $item->product_qty * $item->products->price; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row row_cart_buttons">
                <div class="col">
                    <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                        <div class="button continue_shopping_button"><a href="{{ route('main.home') }}">Continue
                                shopping</a></div>
                        <div class="cart_buttons_right ml-lg-auto">
                            <div class="button clear_cart_button"><a href="#">Clear cart</a></div>
                            <div class="button update_cart_button"><a href="#">Update
                                    cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row_extra">
                <div class="col-lg-4">

                    <!-- Delivery -->
                    <div class="delivery">
                        <div class="section_title">Shipping method</div>
                        <div class="section_subtitle">Select the one you want</div>
                        <div class="delivery_options">
                            <label class="delivery_option clearfix">Next day delivery
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                                <span class="delivery_price">$4.99</span>
                            </label>
                            <label class="delivery_option clearfix">Standard delivery
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                                <span class="delivery_price">$1.99</span>
                            </label>
                            <label class="delivery_option clearfix">Personal pickup
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                                <span class="delivery_price">Free</span>
                            </label>
                        </div>
                    </div>

                    <!-- Coupon Code -->
                    <div class="coupon">
                        <div class="section_title">Coupon code</div>
                        <div class="section_subtitle">Enter your coupon code</div>
                        <div class="coupon_form_container">
                            <form action="#" id="coupon_form" class="coupon_form">
                                <input type="text" class="coupon_input" required="required">
                                <button class="button coupon_button"><span>Apply</span></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 offset-lg-2">
                    <div class="cart_total">
                        <div class="section_title">Cart total</div>
                        <div class="section_subtitle">Final info</div>
                        <div class="cart_total_container">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Subtotal</div>
                                    <div class="cart_total_value ml-auto">${{ $total_price }}</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Shipping</div>
                                    <div class="cart_total_value ml-auto">Free</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Total</div>
                                    <div class="cart_total_value ml-auto">${{ $total_price }}</div>
                                </li>
                            </ul>
                        </div>
                        <div class="button checkout_button"><a href="#">Proceed to checkout</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
