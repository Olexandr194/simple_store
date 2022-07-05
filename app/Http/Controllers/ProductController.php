<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($category_title, $product_id){
        $item = Product::where('id', $product_id)->first();
        $categories = Category::all();

        return view('product.show', compact('item', 'categories'));
    }
}
