<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($category, $product_id){
        $item = Product::where('id', $product_id)->first();
        $category = Category::all();

        return view('product.index', compact('item', 'category'));
    }

}
