<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function create(): View
    {
        return view('home');
    }

    public function store(Request $request): Category
    {
        $request->validate([
            'name'  =>  'required|min:3'
        ]);
        return Category::create($request->all());
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'msg'   =>  'Deleted Successfully'
        ]);
    }
}
