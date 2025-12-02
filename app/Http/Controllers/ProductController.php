<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::all();

        $search = $request->input('search');
        $sort_by = $request->input('sort_by', 'name');
        $order = $request->input('order', 'asc');

        $products = Product::when($search, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
    ->orderBy($sort_by, $order)
    ->paginate(5)
    ->appends($request->only(['search', 'sort_by', 'order']));
    
        return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
