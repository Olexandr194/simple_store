@extends('layouts.main')

@section('title', 'Checkout')
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
@endsection

@section('custom_js')
    <script>

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
                                        <li><a href="{{ route('main.cart.index') }}">Shopping Cart</a></li>
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

    <div class="cart_info mb-5">
        <div class="container">
            <form action="{{ route('main.order.index') }}" method="POST">
                @csrf
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Деталі замовлення</h4>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Фото</th>
                                    <th>Назва товару</th>
                                    <th>Кількість</th>
                                    <th>Вартість</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $total_price =0; @endphp
                                @foreach($items as $item)

                                    <tr>
                                        <td><img src="{{ url('storage/' . $item->products->image) }}" alt="image" class="bg-transparent w-25"></td>
                                        <td class="text-center">{{ $item->products->title }}</td>
                                        <td class="text-center">{{ $item->product_qty }}</td>
                                        <td class="text-center">${{ $item->products->price * $item->product_qty }}</td>
                                    </tr>
                                    @php $total_price += $item->product_qty * $item->products->price; @endphp
                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <tr>Загальна вартість: ${{ $total_price }}</tr>
                            <input type="hidden" class="form-control" name="total_price" value="{{ $total_price }}">
                            <hr>
                            <button class="btn btn-dark float-right" type="submit" onclick="return alert('Дякуємо за покупку!)')" href="{{ route('main.order.index') }}">Замовити</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
