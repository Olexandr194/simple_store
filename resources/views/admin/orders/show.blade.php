@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h4>Деталі замовлення</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Замовник:</h4>
                                        <hr>
                                        <label>Ім'я</label>
                                        <div class="border"> {{ $order->users->name }}</div>
                                        <label>Прізвище</label>
                                        <div class="border"> {{ $order->users->surname }}</div>
                                        <label>Email</label>
                                        <div class="border"> {{ $order->users->email }}</div>
                                        <label>Адреса</label>
                                        <div class="border"> {{ $order->users->address }}</div>
                                        <label>Контактний номер</label>
                                        <div class="border"> {{ $order->users->phone }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>Замовлення:</h4>
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
                                            @foreach($order->new_orders as $item)

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
                                        <h4 class="px-2"><strong> Загальна вартість: <span class="float-right"> {{ $order->total_price }}$</span> </strong></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

