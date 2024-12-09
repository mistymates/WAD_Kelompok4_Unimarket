<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Buyer\CatalogController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Seller\TransactionController;
use App\Http\Controllers\Buyer\ReviewController;
use App\Http\Controllers\Buyer\ChatController;
use App\Http\Controllers\Buyer\SupportController;
use App\Http\Controllers\Seller\ChatController as SellerChatController;
use App\Http\Controllers\Buyer\OrderController;

Route::get('/', [CatalogController::class, 'index'])->name('home'); // Home page
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog'); // Catalog listing
Route::get('/product/{id}', [CatalogController::class, 'show'])->name('product.show'); // Product details

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart'); // View cart
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store'); // Add to cart
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.remove'); // Remove from cart
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout'); // Checkout
    Route::post('/order', [OrderController::class, 'store'])->name('order.store'); // Place order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // View orders
    Route::get('/reviews/{productId}', [ReviewController::class, 'create'])->name('review.create'); // Create review
    Route::post('/reviews/{productId}', [ReviewController::class, 'store'])->name('review.store'); // Store review
    Route::get('/chat', [ChatController::class, 'index'])->name('chat'); // Buyer chat
    Route::get('/support', [SupportController::class, 'index'])->name('support'); // Support page
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/products', [ProductController::class, 'index'])->name('seller.products'); // List products
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.products.create'); // Create product
    Route::post('/seller/products', [ProductController::class, 'store'])->name('seller.products.store'); // Store product
    Route::get('/seller/products/{productId}/edit', [ProductController::class, 'edit'])->name('seller.products.edit'); // Edit product
    Route::put('/seller/products/{productId}', [ProductController::class, 'update'])->name('seller.products.update'); // Update product
    Route::delete('/seller/products/{productId}', [ProductController::class, 'destroy'])->name('seller.products.delete'); // Delete product
    Route::get('/seller/transactions', [TransactionController::class, 'index'])->name('seller.transactions'); // Seller transactions
    Route::get('/seller/chat', [SellerChatController::class, 'index'])->name('seller.chat'); // Seller chat
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users'); // Manage users
    Route::delete('/admin/users/{userId}', [UserManagementController::class, 'deleteUser'])->name('admin.users.delete'); // Delete user
    Route::get('/admin/products', [ProductManagementController::class, 'index'])->name('admin.products'); // Manage products
    Route::get('/admin/reviews', [ProductManagementController::class, 'manageReviews'])->name('admin.reviews'); // Manage reviews
    Route::get('/admin/transactions', [ProductManagementController::class, 'manageTransactions'])->name('admin.transactions'); // Manage transactions
});

Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/test', function () {
    return 'Laravel is working!';
});
