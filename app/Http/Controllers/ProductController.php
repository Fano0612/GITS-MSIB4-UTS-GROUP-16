<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Barang::with('categories')->get();
        $productIds = $products->pluck('id_barang')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();

        return view('product_manage', compact('products', 'productCategories'));
    }

    public function index2()
    {
        $products = Barang::with('categories')->get();
        $productIds = $products->pluck('id_barang')->toArray();
        $productCategories = Category::whereIn('id', $productIds)->get();

        return view('product_manage2', compact('products', 'productCategories'));
    }

    public function insertproduct(Request $insertion)
    {
        $validatedData = $insertion->validate([
            'id_barang' => 'required|unique:barang,id_barang',
            'namabarang' => 'required',
            'jenisbarang' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'komposisi' => 'required',
            'tanggalkedaluwarsa' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'jumlahstokbarang' => 'required|numeric',
            'kategori_id' => 'required|numeric', ], 
            [
                'id_barang.unique' => 'ID Barang sudah terdaftar!',
                'id_barang.required' => 'ID Barang Kosong!',
                'namabarang.required' => 'Nama Barang Kosong!',
                'jenisbarang.required' => 'Jenis Barang Kosong!',
                'harga.required' => 'Harga Barang Kosong!',
                'deskripsi.required' => 'Deskripsi Barang Kosong!',
                'komposisi.required' => 'Komposisi Barang Kosong!',
                'tanggalkedaluwarsa.required' => 'Tanggal Kedaluwarsa Barang Kosong!',
                'foto.required' => 'Foto Barang Kosong!',
                'jumlahstokbarang.required' => 'Jumlah Stok Barang Kosong!',
                'kategori_id.required' => 'Kategori Barang Kosong!',
            ]);

        $productPicture = '';
        if ($insertion->hasFile('foto')) {
            $productPicture = $insertion->file('foto');
            $imageName = time() . '.' . $productPicture->getClientOriginalExtension();
            $productPicture->move(public_path('images/product_pictures'), $imageName);
            $productPicture = $imageName;
        }

        Barang::create([
            'id_barang' => $validatedData['id_barang'],
            'namabarang' => $validatedData['namabarang'],
            'jenisbarang' => $validatedData['jenisbarang'],
            'harga' => $validatedData['harga'],
            'deskripsi' => $validatedData['deskripsi'],
            'komposisi' => $validatedData['komposisi'],
            'tanggalkedaluwarsa' => $validatedData['tanggalkedaluwarsa'],
            'foto' => $productPicture,
            'jumlahstokbarang' => $validatedData['jumlahstokbarang'],
            'kategori_id' => $validatedData['kategori_id'],
        ]);

        return redirect()->route('product_menu')->with('success', 'Data Successfully Added');
    }


    public function showproduct($id)
    {
        $productdata = Barang::find($id);
        $product_categories = Category::all();
        return view('product_update', compact('productdata', 'product_categories'));
    }



    public function editproduct(Request $dataupdate, $id)
    {

        $productData = Barang::find($id);
        $categories = Category::all();
        $validatedData = $dataupdate->validate([
            'id_barang' => 'nullable',
            'namabarang' => 'nullable',
            'jenisbarang' => 'nullable',
            'harga' => 'nullable|numeric',
            'deskripsi' => 'nullable',
            'komposisi' => 'nullable',
            'tanggalkedaluwarsa' => 'nullable',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'jumlahstokbarang' => 'nullable|numeric',
            'kategori_id' => 'nullable',
        ]);

        $kategori_id = (int) $validatedData['kategori_id'];

        if ($productData) {
            $productData->update([
                'id_barang' => $validatedData['id_barang'],
                'namabarang' => $validatedData['namabarang'],
                'jenisbarang' => $validatedData['jenisbarang'],
                'harga' => $validatedData['harga'],
                'deskripsi' => $validatedData['deskripsi'],
                'komposisi' => $validatedData['komposisi'],
                'tanggalkedaluwarsa' => $validatedData['tanggalkedaluwarsa'],
                'jumlahstokbarang' => $validatedData['jumlahstokbarang'],
                'kategori_id' => $validatedData['kategori_id'],
            ]);

            if ($dataupdate->hasFile('foto')) {
                $file = $dataupdate->file('foto');
                $file_name = $file->getClientOriginalName();
                $file_path = $file->move(public_path('images/product_pictures'), $file_name);
                $productData->product_picture = $file_name;
                $productData->save();
            }

            return redirect()->route('product_menu')->with(['productdata' => $productData, 'categories' => $categories]);
        } else {
            return redirect()->route('product_menu')->with('error', 'Data Not Found');
        }
    }




    public function deleteProduct($id)
    {
        $productData = Barang::find($id);
        if ($productData) {
            $productData->delete();
            return redirect()->route('product_menu')->with('success', 'Data Successfully Deleted');
        } else {
            return redirect()->route('product_menu')->with('error', 'Data Not Found');
        }
    }
    public function buyProduct(Request $request)
    {
        $productId = $request->input('product_id'); 
    
        $product = Barang::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        $userId = auth()->user()->id;
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
                'product_name' => $product->namabarang, 
                'product_picture' => $product->foto,
                'product_price' => $product->harga, 
            ]);
        }
        $product->decrement('jumlahstokbarang', 1);
    
        return redirect()->back()->with('success', 'Product successfully added to the cart!');
    }

    public function getProductDetails($id) {
        $product = Barang::find($id);
        return response()->json($product);
    }
    
    
    public function showProductCart()
    {
        $userId = auth()->user()->id;

        $cart = Cart::where('user_id', $userId)->get();
        return view('cart_view', compact('cart'));
    }

    public function incrementProductCart(Request $request)
    {
        $productId = $request->input('id_barang');
        $userId = auth()->user()->id;
        $cart = Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Product not found in cart!');
        }
        $product = Barang::find($productId);
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

    public function decrementProductCart(Request $request)
    {
        $productId = $request->input('id_barang');
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
        $product = Barang::find($productId);
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

    public function removeProductCart($id)
    {
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
                    'jumlahstokbarang' => $productStock
                ]);
            }

            $cartItem->delete();

            if ($cartItem->deleted_at) {
                $product = Barang::find($id);
                if ($product) {
                    $productStock = $product->product_stock + $removedQuantity;
                    $product->update([
                        'jumlahstokbarang' => $productStock
                    ]);
                }
            }

            return redirect()->route('showProductCart')->with('success', 'Product removed');
        } else {
            return redirect()->route('showProductCart')->with('error', 'Product not found');
        }
    }

    public function paymentProductCart()
    {
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
                'product_price' => $cartItem->product_price,
                'quantity' => $cartItem->quantity,
                'transaction_status' => 'Paid'
            ];

            $product = $cartItem->product;
            if ($product) {
                $productStock = $product->product_stock - $cartItem->quantity;
                $product->update([
                    'jumlahstokbarang' => $productStock
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
    public function viewProductTransaction3($transaction_id)
    {
        $transaction = Transaction::with('user', 'product')->where('transaction_id', $transaction_id)->firstOrFail();
        $products = Transaction::where('transaction_id', $transaction_id)->get();

        return view('transaction_view3', compact('transaction', 'products'));
    }
}
