<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;


Route::get('/', [ProductController::class, 'homePage'])->name('welcome');



// تسجيل المستخدم (عرض صفحة التسجيل)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// تسجيل المستخدم (معالجة بيانات التسجيل)
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');


// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// مسار عرض المنتجات متاح للجميع (ضيوف ومستخدمين مسجلين)
Route::get('/products', [ProductController::class, 'index'])->name('products.products');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');


Route::post('/products/{id}/buy', [ProductController::class, 'buy'])->name('products.buy');


// المسارات الأخرى محمية وتحتاج لتسجيل الدخول
Route::middleware(['auth'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/orders/{id}', [ProductController::class, 'destroyO'])->name('orders.destroyO');

    
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/products/orders', [ProductController::class, 'orders'])->name('products.orders')->middleware('auth');

Route::get('/search', [ProductController::class, 'search'])->name('products.search');
