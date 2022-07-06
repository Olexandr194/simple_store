<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index($product_id){
        $cat = Category::where('id', $product_id)->first();
        $products = Product::all();

        return view('categories.index', compact('products', 'cat'));
    }
}
