<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $items = Card::where('user_id', Auth::id())->get();
        return view('checkout.index', compact('items'));
    }
}
