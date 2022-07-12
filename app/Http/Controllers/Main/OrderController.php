<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\NewOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = $request->input('total_price');
        $order->save();

        $items = Card::where('user_id', Auth::id())->get();
        foreach ($items as $item){
            NewOrder::create([
                'product_id' => $item->product_id,
                'product_qty' => $item->product_qty,
                'price' => $item->products->price,
                'user_id' => Auth::id(),
                'order_id' => $order->id,
            ]);
        }
        $items = Card::where('user_id', Auth::id())->get();
        Card::destroy($items);

        return redirect()->route('main.home');
    }
}
