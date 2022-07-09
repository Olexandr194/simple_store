<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add(Request $request)
    {
        $product_id = $request->input('id');
        $product_qty = $request->input('qty');

        if(Auth::check())
        {
            $product = Product::where('id', $product_id)->first();

            if($product)
            {
                if(Card::where('product_id', $product_id)->where('user_id', Auth::id())->exists())
                {
                    return response()->json(['status' => "Даний продукт уже знаходиться в кошику"]);
                }
                else
                {
                    $cartItem = new Card();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => "Продукт додано у кошик"]);
                }
            }
        }
        else
        {
            return response()->json(['status' => "Авторизуйтеся щоб продовжити."]);
        }
    }
}
