<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->take(8)->get();
        $categories = Category::all();


        return view('home.index', compact('products', 'categories'));
    }
}
