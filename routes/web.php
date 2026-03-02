<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
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

    // Auth hub (login/register options)
    Route::get('/login', function() { return view('auth.login'); })->name('auth.login');

    // Customer registration
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Admin registration
    Route::get('/admin/register', [AuthController::class, 'showAdminRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('admin.register.post');

    // Customer Sign In
    Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin');
    Route::post('/signin', [AuthController::class, 'signinCustomer'])->name('signin.post');

    // Admin Sign In
    Route::get('/admin/signin', [AuthController::class, 'showAdminSigninForm'])->name('admin.signin');
    Route::post('/admin/signin', [AuthController::class, 'signinAdmin'])->name('admin.signin.post');

    // Sign Out (both guards)
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
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Account / Profile
Route::middleware('auth')->group(function () {
Route::get('/account', [AccountController::class, 'index'])->name('account.index');
Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');
Route::delete('/account/delete', [AccountController::class, 'destroy'])->name('account.delete');
Route::put('/account/password', [AccountController::class, 'changePassword'])->name('account.change-password');
});


// --------------------
// Returns
// --------------------
Route::get('/orders/{order}/return', [FinalOrderController::class, 'showReturnForm'])->name('orders.return');
Route::post('/orders/{orderItem}/return', [ReturnRequestController::class, 'submitReturnRequest'])->name('return.submit');


// --------------------
// Admin Inventory Management
// --------------------
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/inventory', [App\Http\Controllers\AdminDashboardController::class, 'inventoryIndex'])->name('inventory.index');
        Route::post('/inventory/report', [App\Http\Controllers\AdminDashboardController::class, 'generateReport'])->name('inventory.report');
        Route::get('/admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('change-password.form');
        Route::put('/admin/change-password', [AdminController::class, 'changePassword'])->name('change-password');
        Route::get('/customers', [App\Http\Controllers\AdminDashboardController::class, 'showCustomers'])->name('customers.index');
        Route::get('/customers/{id}', [App\Http\Controllers\AdminDashboardController::class, 'viewCustomer'])->name('customers.show');
        Route::get('/customers/{id}/edit', [App\Http\Controllers\AdminDashboardController::class, 'editCustomer'])->name('customers.edit');
        Route::put('/customers/{id}', [App\Http\Controllers\AdminDashboardController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{id}', [App\Http\Controllers\AdminDashboardController::class, 'destroyCustomer'])->name('customers.destroy');
        Route::post('/inventory/{id}/restock', [App\Http\Controllers\AdminDashboardController::class, 'restock'])->name('inventory.restock');
        Route::delete('/inventory/{id}', [App\Http\Controllers\AdminDashboardController::class, 'destroy'])->name('inventory.delete');
        Route::get('/inventory/create', [App\Http\Controllers\AdminDashboardController::class, 'createProduct'])->name('inventory.create');
        Route::post('/inventory', [App\Http\Controllers\AdminDashboardController::class, 'storeProduct'])->name('inventory.store');
        Route::get('/inventory/{id}/edit', [App\Http\Controllers\AdminDashboardController::class, 'editProduct'])->name('inventory.edit');
        Route::put('/inventory/{id}', [App\Http\Controllers\AdminDashboardController::class, 'updateProduct'])->name('inventory.update');
        Route::get('/orders', [FinalOrderController::class, 'adminIndex'])->name('orders.index');
        Route::get('/orders/{order}', [FinalOrderController::class, 'adminShow'])->name('orders.show');
        Route::post('/orders/{order}/update-status', [FinalOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });