<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tahun' => 'required|integer',
            'harga_sewa' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'nama_mobil' => $request->nama_mobil,
            'category_id' => $request->category_id,
            'tahun' => $request->tahun,
            'harga_sewa' => $request->harga_sewa,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'tahun' => 'required|integer',
            'harga_sewa' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }

            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
           'nama_mobil' => $request->nama_mobil,
            'category_id' => $request->category_id,
            'tahun' => $request->tahun,
            'harga_sewa' => $request->harga_sewa,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {

        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        return redirect()->route('products.index');
    }
}
