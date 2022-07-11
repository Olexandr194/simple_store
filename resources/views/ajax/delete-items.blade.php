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
                <div class="cart_item_edit"><button class="btn btn-danger delete-item">Remove Product</button></div>
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
