<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\Brand\Index;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Category;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // category route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){
        Route::get('/category/index', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/category/create', [CategoryController::class, 'create']);
        Route::post('/category', [CategoryController::class,'store']);
        Route::get('/category/{category}/edit',[CategoryController::class, 'edit']);
        Route::put('/category/{category}',[CategoryController::class, 'update']);
        Route::delete('/category/{category}', [CategoryController::class, 'destroy']);    
    });

    // product route
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function(){
        Route::get('/products/index', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{product}/edit', [ProductController::class, 'edit']);
        Route::put('/products/{product}', 'update')->name('admin.products.update');
        Route::get('products/{$product_id}/delete','destroy')->name('admin.products.delete');
        Route::get('product-image/{product_image_id}/delete','destroyImage')->name('admin.products.image.delete');
    });
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);
});



