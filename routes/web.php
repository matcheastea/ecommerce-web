<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\Brand\Index;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Livewire\Frontend\Product\View as ProductView;

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
Route::get('/collections', [\App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('collections/{category_id}',[\App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('collections/{category_id}/{product_id}',[\App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/checkout/preview/{order_id}', [CheckoutController::class, 'preview'])->name('checkout.preview');

Route::middleware(['auth'])->group(function(){
    Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin route
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // category route
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){
        Route::get('/category/index', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/category/create', [CategoryController::class, 'create']);
        Route::post('/category', [CategoryController::class,'store']);
        Route::get('/category/{category}/edit',[CategoryController::class, 'edit']);
        Route::put('/category/{category},', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy']);    
    });

    // product route
    
    Route::prefix('products')->name('admin.products.')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('{product}',[ProductController::class, 'update']);
        Route::get('{product}/delete', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::get('/product-image/{product_image_id}/delete', [ProductController::class, 'destroyImage'])->name('admin.products.image.delete');

    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);

    //orders
    

});



