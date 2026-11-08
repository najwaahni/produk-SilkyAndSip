<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomTreatController;
use App\Http\Controllers\AiAssistantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// 1. Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Shop / Indulgent Catalog
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

// 3. Custom Treat / Interactive Studio
Route::get('/custom', [CustomTreatController::class, 'index'])->name('custom.index');
Route::post('/custom/add-to-cart', [CustomTreatController::class, 'addToCart'])->name('custom.add');

// 4. AI Assistant / Taste Architect
Route::get('/ai-assistant', [AiAssistantController::class, 'index'])->name('ai.index');
Route::post('/ai-assistant/chat', [AiAssistantController::class, 'chat'])->name('ai.chat');

// 5. Cart & Checkout
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.process');

// 6. Order Success & Invoice
Route::get('/order-success/{id}', [OrderController::class, 'success'])->name('order.success');
Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('order.invoice');

// 7. Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// 8. Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.status');
});
