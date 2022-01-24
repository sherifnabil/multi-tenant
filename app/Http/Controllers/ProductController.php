<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    public function index($id): Collection
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

    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'msg'   =>  'Deleted Successfully'
        ]);
    }
}
