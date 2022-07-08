<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    public function index(\Darryldecode\Cart\Cart $items)
    {
        return view('cart.index', compact($items));
    }

    public function add(Request $request)
    {

        $product = Product::where('id', $request->id)->first();


        /* isset($_COOKIE['cart_id']) ? \Cart::session($_COOKIE['cart_id'])->getTotalQuantity() : '0';*/

        if (!isset($_COOKIE['cart_id'])) setcookie('cart_id', uniqid());
        $cart_id = $_COOKIE['cart_id'];
        \Cart::session($cart_id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => (int)$request->qty,
            'attributes' => [
                'img' => $product->image ?? 'no_image.png'
            ]
        ]);

        $items = \Cart::getContent();

        /*return response()->json(\Cart::getContent());*/

        return (compact('items'));
    }
}
