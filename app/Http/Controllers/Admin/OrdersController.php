<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\NewOrder;


class OrdersController extends Controller
{
    public function index()
    {
        $orders = NewOrder::all();
        return view('admin.orders.index', compact('orders'));
    }


}
