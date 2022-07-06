<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($category, $product_id){
        $item = Product::where('id', $product_id)->first();
        $category = Category::where('id', $item->category_id)->first();
        return view('product.index', compact('item', 'category'));
    }

}
