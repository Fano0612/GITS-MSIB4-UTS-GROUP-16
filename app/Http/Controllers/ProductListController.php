<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        $productIds = $products->pluck('product_id')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();
    
        return view('product_list', compact('products', 'productCategories'));
    }

    public function showproduct($id)
    {
        $productdata = Product::find($id);
        $product_categories = Category::all();
        return view('product_list', compact('productdata', 'product_categories'));
    }
   
    
  
}
