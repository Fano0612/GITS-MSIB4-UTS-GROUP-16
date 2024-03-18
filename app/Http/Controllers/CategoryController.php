<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        if (!is_array($category)) {
        }
        return view('category_manage', compact('category'));
    }
    

    public function create()
    {
        $category = Category::all();
        session(['category_manage' => true]);
        return view('category_manage', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|digits:1|unique:categories,id',
            'product_category' => 'required|max:255|unique:categories,product_category'], 
            [ 'id.digits' => 'ID must be exactly 1 digit.','id.unique' => 'ID already exists in the database.',
            'product_category.unique' => 'Product category already exists in the database.',
            'product_category.max' => 'Product category must not exceed 255 characters.']);


    
            Category::create($request->all());
    
        return redirect()->route('category')
            ->with('success', 'Category created successfully.');
    }
    

    

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('category_update', compact('category'));
    }
    public function edit($id)
    {
        if(!session('category_manage')){
            return redirect()->route('category');
        }
        session()->forget('category_manage');

        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        return view('category_update', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_category' => 'required|unique:categories|max:255'
        ]);
    
        $category = Category::find($id);
        $category->product_category = $request->product_category;
        $category->save();
    
        return redirect()->route('category')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('category')
            ->with('success', 'Category deleted successfully.');
    }


    public function index2()
    {
        $category = Category::all();
        if (!is_array($category)) {
        }
        return view('category_manage2', compact('category'));
    }
    

    public function create2()
    {
        $category = Category::all();
        session(['category_manage2' => true]);
        return view('category_manage2', compact('category'));
    }

    public function store2(Request $request)
    {
        $request->validate([
            'id' => 'required|digits:1|unique:categories,id',
            'product_category' => 'required|max:255|unique:categories,product_category'], 
            [ 'id.digits' => 'ID must be exactly 1 digit.','id.unique' => 'ID already exists in the database.',
            'product_category.unique' => 'Product category already exists in the database.',
            'product_category.max' => 'Product category must not exceed 255 characters.']);


    
            Category::create($request->all());
    
        return redirect()->route('category2')
            ->with('success', 'Category created successfully.');
    }
    

    

    public function show2($id)
    {
        $category = Category::findOrFail($id);
        return view('category_update2', compact('category'));
    }
    public function edit2($id)
    {
        if(!session('category_manage2')){
            return redirect()->route('category2');
        }
        session()->forget('category_manage2');

        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        return view('category_update2', compact('category'));
    }
    
    public function update2(Request $request, $id)
    {
        $request->validate([
            'product_category' => 'required|unique:categories|max:255'
        ]);
    
        $category = Category::find($id);
        $category->product_category = $request->product_category;
        $category->save();
    
        return redirect()->route('category2')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy2($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('category2')
            ->with('success', 'Category deleted successfully.');
    }


}
