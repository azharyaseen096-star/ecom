<?php
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WikiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Shop
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/shop', [ProductController::class, 'index'])
        ->name('shop');

});


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::get('/cart/increase/{id}', [CartController::class, 'increase'])
        ->name('cart.increase');

    Route::get('/cart/decrease/{id}', [CartController::class, 'decrease'])
        ->name('cart.decrease');

});


/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    Route::post('/place-order', [CartController::class, 'checkout'])
        ->name('place.order');

    Route::get('/success', function () {
        return view('success');
    })->name('success');

});


/*
|--------------------------------------------------------------------------
| Wiki Smart Search
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/wiki', [WikiController::class, 'index'])
        ->name('wiki.index');

    Route::post('/wiki/search', [WikiController::class, 'search'])
        ->name('wiki.search');

    // Support titles with spaces and slashes
    Route::get('/wiki/show/{title}', [WikiController::class, 'show'])
        ->where('title', '.*')
        ->name('wiki.show');

});
/*
|--------------------------------------------------------------------------
| Universal Search
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/search', [SearchController::class, 'index'])
        ->name('search.index');

    Route::post('/search', [SearchController::class, 'search'])
        ->name('search.search');

});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/orders', [AdminController::class, 'orders'])
        ->name('admin.orders');

    Route::get('/admin/products/create', [AdminController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/admin/products/store', [AdminController::class, 'store'])
        ->name('admin.products.store');

    Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit'])
        ->name('admin.products.edit');

    Route::post('/admin/products/{id}/update', [AdminController::class, 'update'])
        ->name('admin.products.update');

    Route::get('/admin/products/{id}/delete', [AdminController::class, 'destroy'])
        ->name('admin.products.delete');

});


require __DIR__.'/auth.php';