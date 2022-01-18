<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\UploadImageController;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin-panel'],function(){
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    // User
    Route::resource('users', UserController::class);
    // Category
    Route::resource('categories', CategoryController::class);
    // Product
    Route::resource('products', ProductController::class);
    // Carousel
    Route::resource('carosel', CaroselController::class);
    //Comments
    Route::get('comments/{id?}', [ProductController::class , 'GetComment'])->name('comments'); 
    Route::get('comments_ststus/{id?}', [ProductController::class , 'PostComment'])->name("active");
   });
   






Route::post('/product/image-destroy/{id?}', [ProductController::class, 'productDestory'])->name('products.image-destroy');

Route::get('test/{id?}', function($id){
    return $data = Category::where('parent_id',$id)->get();
    return view('test',compact('data'));
});
Route::get('image',function(){
    $img = request()->image;
    $path = storage_path('/app/' . $img);
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('image-show');
Route::get('upload-image', [UploadImageController::class, 'index']);
Route::post('save', [UploadImageController::class, 'save'])->name('img-upload');

// 
// front - routes
// 

Route::get('/', [IndexController::class, 'index']);
Route::get('/categories/{id?}', [IndexController::class, 'categories'])->name('categories.index');

Route::get('wishlist', [IndexController::class, 'wishlist']);
Route::post('wishlist/{id?}/{type?}', [IndexController::class, 'add_or_delete_from_wishlist']);
Route::get('user-auth', [IndexController::class, 'get_login']);
Route::post('user-login', [IndexController::class, 'post_login']);
Route::post('user-register', [IndexController::class, 'post_register']);

Route::get('product-detail/{id?}', [IndexController::class, 'productDetail'])->name('product_detail');
Route::post('comment-post/{id?}', [IndexController::class, 'commentPost'])->name('comment_post');

Route::post('search', [IndexController::class, 'search']);
Route::post('searchProducer', [IndexController::class, 'searchProducer']);

Route::get('categories/price/filter',  [IndexController::class, 'priceFilter']);
// user
Route::group(['prefix' => 'user'],function(){
    Route::get('account', [IndexController::class, 'account_get']);
    Route::post('account', [IndexController::class, 'account_post'])->name('user-account');
    
    Route::get('address', [IndexController::class, 'address_get']);
    Route::post('address', [IndexController::class, 'address_post'])->name('address_post');

    Route::get('get-data', [IndexController::class, 'get_producers']);
    Route::get('get-wish-data', [IndexController::class, 'get_wish_data']);
    Route::get('get-wishlist-producers', [IndexController::class, 'get_wish_producers']);
});
// producer
Route::group(['prefix' => 'producer'],function(){
    Route::get('account', [IndexController::class, 'account_get']);
   
    Route::get('products', [IndexController::class, 'producer_products']);
    Route::get('edit-product/{id?}', [IndexController::class, 'edit_product'])->name('edit_product');
    Route::post('edit-product/{id?}', [IndexController::class, 'update_product'])->name('producer_product.update');

    Route::get('create-product/{id?}', [IndexController::class, 'create_product'])->name('create_product');
    Route::post('create-product/{id?}', [IndexController::class, 'store_product'])->name('store_product');

    Route::get('address', [IndexController::class, 'address_get']);

   
});
