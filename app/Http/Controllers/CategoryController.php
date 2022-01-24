<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    public function __construct()
    {
        // logged in user is saved in the session as auth_user or can be saved if use jwt and can be send to verify that user
    }

    public function index(): Collection
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

    public function destroy($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'msg'   =>  'Deleted Successfully'
        ]);
    }
}
