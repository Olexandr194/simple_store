<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function add(Request $request)
    {
        $product_id = $request->input('id');
        $product_qty = $request->input('qty');

        if (Auth::check()) {
            $product = Product::where('id', $product_id)->first();
            if ($product) {
                if (Card::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => "Даний продукт уже знаходиться в кошику"]);
                } else {
                    $cartItem = new Card();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => "Продукт додано у кошик"]);
                }
            }
        } else {
            return response()->json(['status' => "Авторизуйтеся щоб продовжити."]);
        }
    }

    public function index()
    {
        $items = Card::where('user_id', Auth::id())->get();
        return view('cart.index', compact('items'));
    }

    public function delete(Request $request)
    {
        $product_id = $request->input('product_id');
        if (Card::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
            $item = Card::where('product_id', $product_id)->where('user_id', Auth::id())->first();
            $item->delete();
        }
        $items = Card::where('user_id', Auth::id())->get();
        if ($request->ajax()) {
            return view('ajax.delete-items',
                ['items' => $items])->render();
        }
        return view('cart.index', compact('items'));
    }

    public function update(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (Card::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
            $item = Card::where('product_id', $product_id)->where('user_id', Auth::id())->first();
            $item->product_qty = $product_qty;
            $item->update();
        }
        $items = Card::where('user_id', Auth::id())->get();
        if ($request->ajax()) {
            return view('ajax.delete-items', compact('items'))->render();
        }
        return view('cart.index', compact('items'));
    }

    public function clear(Request $request)
    {

        $items = Card::where('user_id', Auth::id())->get();
        if(isset($items))
        {
            foreach ($items as $item) {
                $item->delete();
            }
        }
        $items = Card::where('user_id', Auth::id())->get();
        if ($request->ajax()) {
            return view('ajax.delete-items', compact('items'))->render();
        }
        return view('cart.index', compact('items'));
    }

    public function updateCart(Request $request)
    {

        $items = Card::where('user_id', Auth::id())->get();
        if(isset($items))
        {
            foreach ($items as $item) {
                $item->update();
            }
        }
        $items = Card::where('user_id', Auth::id())->get();
        if ($request->ajax()) {
            return view('ajax.delete-items', compact('items'))->render();
        }
        return view('cart.index', compact('items'));
    }
}




