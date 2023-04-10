<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        $productIds = $products->pluck('product_id')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();
    
        return view('product_manage', compact('products', 'productCategories'));
    }
    
    public function insertproduct(Request $insertion)
{
    $validatedData = $insertion->validate([
        'product_id' => 'required',
        'product_name' => 'required',
        'product_price' => 'required|numeric',
        'product_stock' => 'required|numeric',
        'category_id' => 'required|numeric',
        'product_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
    ]);

    $productPicture = '';
    if ($insertion->hasFile('product_picture')) {
        $productPicture = $insertion->file('product_picture');
        $imageName = time() . '.' . $productPicture->getClientOriginalExtension();
        $productPicture->move(public_path('images/product_pictures'), $imageName);
        $productPicture = $imageName;
    }
    
    Product::create([
        'product_id' => $validatedData['product_id'],
        'product_name' => $validatedData['product_name'],
        'product_price' => $validatedData['product_price'],
        'product_stock' => $validatedData['product_stock'],
        'category_id' => $validatedData['category_id'],
        'product_picture' => $productPicture,
    ]);
    
    return redirect()->route('product_menu')->with('success','Data Successfully Added');
}

        
    public function showproduct($id)
    {
        $productdata = Product::find($id);
        $product_categories = Category::all();
        return view('product_update', compact('productdata', 'product_categories'));
    }
   
    
           
    public function editproduct(Request $dataupdate, $id){

        $productData = Product::find($id);
        $categories = Category::all();
        $validatedData = $dataupdate->validate([
            'product_id' => 'required',
            'product_name' => 'nullable',
            'product_price' => 'nullable|numeric',
            'product_stock' => 'nullable|numeric',
            'category_id' => 'nullable',
            'product_picture' => 'nullable|image|max:2048', 
        ]);
    
        $category_id = (int) $validatedData['category_id'];
    
        if ($productData) {
            $productData->update([
                'product_id' => $validatedData['product_id'],
                'product_name' => $validatedData['product_name'],
                'product_price' => $validatedData['product_price'],
                'product_stock' => $validatedData['product_stock'],
                'category_id' => $category_id,
            ]);
    
            if ($dataupdate->hasFile('product_picture')) {
                $file = $dataupdate->file('product_picture');
                $file_name = $file->getClientOriginalName();
                $file_path=$file->move(public_path('images/product_pictures'), $file_name);
                $productData->product_picture = $file_name; 
                $productData->save();
            }
    
            return redirect()->route('product_menu')->with(['productdata' => $productData, 'categories' => $categories]);
        } else {
            return redirect()->route('product_menu')->with('error','Data Not Found');
        }
    }
    
    
    
        
    public function deleteProduct($id){
        $productData = Product::find($id);
        if ($productData) {
            $productData->delete();
            return redirect()->route('product_menu')->with('success', 'Data Successfully Deleted');
        } else {
            return redirect()->route('product_menu')->with('error', 'Data Not Found');
        }
    }
}
