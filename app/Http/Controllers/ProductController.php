<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function buyProduct(Request $request){

        $productId = $request->input('product_id');
        $product = Product::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        $userId = auth()->user()->id;
        $cartCount = Cart::where('user_id', $userId)->count();
        if ($cartCount == 0) {
            DB::statement('ALTER TABLE carts AUTO_INCREMENT = 1');
        }
    
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
                'product_name' => $product->product_name,
                'product_picture' => $product->product_picture,
                'product_price' => $product->product_price,
            ]);
        }
    
        $product->decrement('product_stock', 1);
    
        return redirect()->route('productlist')->with('success', 'Product successfully added to the cart!');
    }

    public function showProductCart(){
        $userId = auth()->user()->id;
        
        $cart = Cart::where('user_id', $userId)->get();
        return view('cart_view', compact('cart'));
    }

    public function incrementProductCart(Request $request) {
        $productId = $request->input('product_id');
        $userId = auth()->user()->id;
        $cart = Cart::where('product_id', $productId)
                    ->where('user_id', $userId)
                    ->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Product not found in cart!');
        }
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        $quantity = $cart->quantity + $request->input('increment');
        if ($quantity > $product->product_stock) {
            return redirect()->back()->with('error', 'Product out of stock!');
        }
        $cart->quantity = $quantity;
        $cart->save();
        $product->product_stock -= $request->input('increment');
        $product->save();
        $data = ['quantity' => $cart->quantity];
        return response()->json($data);
    }
    
    public function decrementProductCart(Request $request) {
        $productId = $request->input('product_id');
        $userId = auth()->user()->id;
    
        $cart = Cart::where('product_id', $productId)
                    ->where('user_id', $userId)
                    ->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Product not found in cart!');
        }
        if ($cart->quantity <= 1) {
            return redirect()->back()->with('error', 'Quantity can not be decreased further!');
        }
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        $quantity = $cart->quantity - $request->input('decrement');
        $cart->quantity = $quantity;
        $cart->save();
        $product->product_stock += $request->input('decrement');
        $product->save();
        $data = ['quantity' => $cart->quantity];
        return response()->json($data);
    }

    public function removeProductCart($id) {
        $userId = auth()->user()->id;
    
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();
        
        if ($cartItem) {
            $removedQuantity = $cartItem->quantity;
    
            $product = $cartItem->product;
            if ($product) {
                $productStock = $product->product_stock + $removedQuantity;
                $product->update([
                    'product_stock' => $productStock
                ]);
            }
            $cartItem->delete();
    
            $product = Product::find($id);
            if ($product) {
                $productStock = $product->product_stock + $removedQuantity;
                $product->update([
                    'product_stock' => $productStock
                ]);
            }
    
            return redirect()->route('showProductCart')->with('success', 'Product removed');
        } else {
            return redirect()->route('showProductCart')->with('error', 'Product not found');
        }
    }
    public function paymentProductCart() {
        $userId = auth()->user()->id;
    
        $cartItems = Cart::where('user_id', $userId)->get();
        $transactionData = [];
    
        $transactionId = time();
    
        foreach ($cartItems as $cartItem) {
            $transactionData[] = [
                'transaction_id' => $transactionId,
                'user_id' => $userId,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product_name,
                'product_picture' => $cartItem->product_picture,
                'product_price' => $cartItem->product_price * $cartItem->quantity,
                'quantity' => $cartItem->quantity,
                'transaction_status' => 'Paid'
            ];
    
            $product = $cartItem->product;
            if ($product) {
                $productStock = $product->product_stock - $cartItem->quantity;
                $product->update([
                    'product_stock' => $productStock
                ]);
            }
        }
    
        Transaction::insert($transactionData);
        Cart::where('user_id', $userId)->delete();
    
        return redirect()->route('showProductCart')->with('success', 'Payment successful');
    }

    public function viewProductTransaction($transaction_id)
    {
        $transaction = Transaction::with('user', 'product')->where('transaction_id', $transaction_id)->firstOrFail();
        $products = Transaction::where('transaction_id', $transaction_id)->get();
    
        return view('transaction_view', compact('transaction', 'products'));
    }
}
