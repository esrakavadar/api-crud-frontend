<?php
 
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;

 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('register',[UserController::class, 'register']); // Kayıt formunu görüntülemek için
Route::post('register',[UserController::class, 'registerPost'])->name('register'); // Kayıt işlemini yapmak için
Route::get('login',[UserController::class, 'login']); // Giriş formunu görüntülemek için
Route::post('login',[UserController::class, 'loginPost'])->name('login'); // Giriş işlemini yapmak için


// Bu grup, oturum yönetimi için giriş yapmış bir kullanıcı gerektirir
//Route::middleware(['auth'])->group(function () {

    // Ürünler sayfası
    Route::get('/products', [AppController::class, 'index'])->name('products');

    // Ürün ekleme sayfası
    Route::get('/products/ekle', [AppController::class, 'create'])->name('products.create');

    // Ürün ekleme formunu işleme
    Route::post('/products', [AppController::class, 'store'])->name('products.store');// buraya kadar okey

    // Belirli bir ürünü görme
    Route::get('/products/show/{id}', [AppController::class, 'show'])->name('products.show');

    // Belirli bir ürünü düzenleme sayfası
    Route::get('/products/edit/{id}', [AppController::class, 'edit'])->name('products.edit');

    // Belirli bir ürünü güncelleme formunu işleme
    Route::put('/products/update/{id}', [AppController::class, 'update'])->name('products.update');

    // Belirli bir ürünü silme
    Route::delete('/products/{id}', [AppController::class, 'destroy'])->name('products.destroy');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//});

// Diğer sayfalar ve rotalar buraya eklenebilir
// Örneğin, ana sayfa, hakkımızda sayfası, iletişim sayfası vb.
