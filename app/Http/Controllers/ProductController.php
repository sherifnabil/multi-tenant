<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index($id)
    {
        $products = Product::where('category_id', $id)->get();
        return $products;
    }

    public function create(): View
    {
        return view('home');
    }

    public function store(Request $request): Product
    {
        $request->validate([
            'name'  =>  'required|min:3',
            'price'  =>  'required|numeric|min:1',
            'category_id'  =>  'required'
        ]);
        return Product::create($request->all());
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'msg'   =>  'Deleted Successfully'
        ]);
    }
}
