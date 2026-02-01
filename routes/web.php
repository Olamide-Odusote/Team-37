<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FinalOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReturnRequestController;


// --------------------
// Public Pages
// --------------------
Route::get('/', [HomeController::class, 'homepage'])->name('home');
Route::get('/about', [ContactController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');


// --------------------
// Authentication
// --------------------
Route::prefix('auth')->group(function () {

    // Customer registration
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Admin registration
    Route::get('/admin/register', [AuthController::class, 'showAdminRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('admin.register.post');

    // Sign-in/out
    Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout.post');

    // Password reset
    Route::get('/password/reset', [AuthController::class, 'showPasswordResetForm'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'changePassword'])->name('password.reset.submit');
});


// --------------------
// Products & Categories
// --------------------
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::resource('products', ProductController::class);
Route::post('/products/{product}/feedback', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');

Route::get('/categories/{category}', [ProductCategoryController::class, 'show'])->name('categories.show');



// --------------------
// Basket
// --------------------
Route::prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'viewBasket'])->name('basket.view');
    Route::post('/add/{product}', [BasketController::class, 'addToBasket'])->name('basket.add');
    Route::post('/remove/{product}', [BasketController::class, 'removeFromBasket'])->name('basket.remove');
    Route::post('/adjust/{product}/{action}', [BasketController::class, 'adjustQuantity'])->name('basket.adjust');
});


// --------------------
// Orders & Checkout
// --------------------
Route::resource('orders', FinalOrderController::class)->only(['index', 'show']);

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// Account / Profile
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account.index');


// --------------------
// Returns
// --------------------
Route::post('/orders/{orderItem}/return', [ReturnRequestController::class, 'submitReturnRequest'])
    ->name('return.submit');


// --------------------
// Admin Inventory Management
// --------------------
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::resource('inventory', InventoryController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        Route::resource('inventory-logs', InventoryLogController::class)
            ->only(['index']);
    });