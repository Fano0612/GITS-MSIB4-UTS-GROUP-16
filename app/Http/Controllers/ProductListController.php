<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public function index2()
    {
        $products = Product::with('categories')->get();
        $productIds = $products->pluck('product_id')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();
    
        return view('product_list2', compact('products', 'productCategories'));
    }

    public function index3()
    {
        $products = Product::with('categories')->get();
        $productIds = $products->pluck('product_id')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();
    
        return view('product_list3', compact('products', 'productCategories'));
    }

    public function index4()
    {
        $user = Auth::user();
    
        if ($user) {
            $user->status_belanja_bantuan_karyawan = 'active';
            $user->save();
        }
    
        $products = Product::with('categories')->get();
        $productIds = $products->pluck('product_id')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();
        return view('cart_view3', compact('products', 'productCategories'));
    }

    public function index5(Request $request)
    {
        $currentUser = Auth::user();
    
        // Check if the request has the user_id parameter
        if ($request->has('id')) {
            // Get the user ID from the request
            $userId = $request->input('id');
            
            // Find the user based on the ID
            $userToBeHelped = User::find($userId);
            
            // Check if the user exists and is not the same as the authenticated user
            if ($userToBeHelped && $userToBeHelped->id !== $currentUser->id) {
                // Copy the user ID to id_pelanggan_belanja_bantuan_karyawan field
                $currentUser->id_pelanggan_belanja_bantuan_karyawan = $userId;
                $currentUser->save();
            }
        }
        $user = Auth::user();
    
        if ($user) {
            $user->status_belanja_bantuan_karyawan = 'active';
            $user->save();
        }
    
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
