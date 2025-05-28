<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\{
    UserController, BranchController, ProductController, CategoryController,
    OrderController, DiscountController, InventoryController, BrandController,
    ItemOrderController, ViewHistoryController, NewsController, DashboardController, AuthController, ReviewController, ProfileController, ConfigController
};

use App\Http\Controllers\Customer\{
    HomeController, CartController, CustomerUserController, CustomerProductController, 
    CustomerCategoryController, CustomerReviewController, LoginController, CustomerOrderController, 
    CustomerBranchController, CustomerNewsController, CustomerDiscountController, CustomerChatgptController
};

Route::get('/', [HomeController::class, 'index'])->name('customer.home.index');

Route::get('/test-chat', [CustomerChatgptController::class, 'ask'])->name('customer.chatgpt.ask');

Route::get('/thong-tin', function () {
    return view('customer.about.index'); 
})->name('customer.about.index');

Route::get('/gio-hang', [CartController::class, 'index'])->name('customer.carts.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('customer.carts.store');
Route::post('/cart/update', [CartController::class, 'update'])->name('customer.carts.update');
Route::post('/cart/destroy', [CartController::class, 'destroy'])->name('customer.carts.destroy');
Route::post('/cart/discount', [CartController::class, 'discount'])->name('customer.carts.discount');

Route::get('/dat-hang', [CustomerOrderController::class, 'create'])->name('customer.orders.create');
Route::post('/dat-hang', [CustomerOrderController::class, 'store'])->name('customer.orders.store');

Route::get('/orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
Route::get('/orders/{id}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');

Route::get('/khach-hang', [CustomerUserController::class, 'index'])->name('customer.users.index');
Route::put('/khach-hang', [CustomerUserController::class, 'update'])->name('customer.users.update');
Route::get('/khach-hang/{id}/don-hang', [CustomerUserController::class, 'orderShow'])->name('customer.users.orderShow');


Route::get('/san-pham', [CustomerProductController::class, 'index'])->name('customer.products.index');
Route::get('/san-pham/{id}', [CustomerProductController::class, 'show'])->name('customer.products.show');

Route::get('/chuyen-muc/{id}', [CustomerCategoryController::class, 'index'])->name('customer.categories.index');

Route::get('/gian-hang', [CustomerBranchController::class, 'index'])->name('customer.branches.index');
Route::get('/cua-hang/{id}', [CustomerBranchController::class, 'show'])->name('customer.branches.show');

Route::get('/ma-giam-gia', [CustomerDiscountController::class, 'index'])->name('customer.discounts.index');

Route::get('/tin-tuc', [CustomerNewsController::class, 'index'])->name('customer.news.index');
Route::get('/tin-tuc/{id}', [CustomerNewsController::class, 'show'])->name('customer.news.show');

Route::get('/dang-nhap', [LoginController::class, 'index'])->name('customer.login.index');
Route::post('/dang-nhap', [LoginController::class, 'submit'])->name('customer.login.submit');

Route::get('/dang-ky', [LoginController::class, 'register'])->name('customer.login.register');
Route::post('/dang-ky', [LoginController::class, 'registerSubmit'])->name('customer.login.registerSubmit');

Route::get('/dang-xuat', [LoginController::class, 'logout'])->name('customer.login.logout');

Route::get('/reviews', [CustomerReviewController::class, 'index'])->name('customer.reviews.index');
Route::post('/reviews', [CustomerReviewController::class, 'store'])->name('customer.reviews.store');

Route::get('/manager/login', [AuthController::class, 'index'])->name('manager.login.index');
Route::post('/manager/login', [AuthController::class, 'submit'])->name('manager.login.submit');

Route::get('/manager/logout', [AuthController::class, 'logout'])->name('manager.login.logout')->middleware('auth');


Route::prefix('manager')
    ->middleware(['auth', 'role:admin,manager'])
    ->name('manager.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('users', UserController::class);
        Route::resource('branches', BranchController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('discounts', DiscountController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('item-orders', ItemOrderController::class);
        Route::resource('view-histories', ViewHistoryController::class);
        Route::resource('news', NewsController::class);
        Route::resource('reviews', ReviewController::class);

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('config', [ConfigController::class, 'index'])->name('config.index');
        Route::put('config', [ConfigController::class, 'update'])->name('config.update');
    });