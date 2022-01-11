<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('categories/store', [CategoryController::class, 'store']);
Route::post('categories/delete/{category}', [CategoryController::class, 'destroy']);

Route::post('category/{id}/products/store', [ProductController::class, 'store']);
Route::post('products/{id}/delete', [ProductController::class, 'destroy']);
Route::get('category/{id}/products', [ProductController::class, 'index']);
