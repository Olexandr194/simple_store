<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\NewOrder;
use App\Models\Order;


class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->first();

        return view('admin.orders.show', compact('order'));
    }


}
