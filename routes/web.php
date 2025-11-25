<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\BasketProductController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FinalOrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
 
// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [ContactController::class, 'about'])->name('about');

// Contact routes
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('submitContact');

// Product routes
Route::resource('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Customer reg
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Admin reg
Route::get('/admin/register', [AuthController::class, 'showAdminRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('admin.register.post');

// Password reset
Route::get('/password/reset', [AuthController::class, 'showPasswordResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'changePassword'])->name('password.reset.submit');

// Admin/Customer sign up
Route::get('/Sign-in', [AuthController::class, 'showSigninForm'])->name('signin');
Route::post('/Sign-in', [AuthController::class, 'signin'])->name('signin.post');
Route::post('/Sign-out', [AuthController::class, 'signout'])->name('signout.post');
 
// Basket pages
Route::get('/basket', [BasketController::class, 'viewBasket'])->name('basket.view');
Route::post('/basket/add/{productId}', [BasketController::class, 'addToBasket'])->name('basket.add');
Route::post('/basket/remove/{productId}', [BasketController::class, 'removeFromBasket'])->name('basket.remove');

// Previous Orders
Route::get('/orders', [FinalOrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [FinalOrderController::class, 'show'])->name('orders.show');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Feedback routes
Route::post('/products/{id}/feedback', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');

// Return request routes
Route::post('/orders/{orderItemId}/return', [ReturnRequestController::class, 'submitReturnRequest'])->name('return.submit');