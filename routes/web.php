<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'tenantToken'], function () {
    Route::post('/api/categories/store', [CategoryController::class, 'store']);
    Route::post('/api/categories/delete/{category}', [CategoryController::class, 'destroy']);
    Route::post('/api/category/{id}/products/store', [ProductController::class, 'store']);
    Route::post('/api/products/{id}/delete', [ProductController::class, 'destroy']);
    Route::get('/api/category/{id}/products', [ProductController::class, 'index']);
});

Route::get('all-categories', [CategoryController::class, 'index'])->middleware('tenantToken');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('tenant');
Route::view('{url}', 'home')->middleware('tenant');
