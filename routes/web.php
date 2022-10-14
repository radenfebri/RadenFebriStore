<?php

use App\Http\Controllers\Backend\AssignPermissionController;
use App\Http\Controllers\Backend\AssignRoleController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\KategoriProdukController;
use App\Http\Controllers\Backend\ManajemenUsersController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PesananController;
use App\Http\Controllers\Backend\ProdukController;
use App\Http\Controllers\Backend\RatingController as BackendRatingController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FavoritController;
use App\Http\Controllers\Frontend\KeranjangController;
use App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\Frontend\RatingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// LANDING PAGE
Route::get('/', [LandingController::class, 'index'])->name('landing.index');

// ADD TO CART
Route::post('add-to-cart', [KeranjangController::class, 'addProduk'])->name('addcart');

// ADD TO FAVORIT
Route::post('add-to-wishlist', [FavoritController::class, 'addFavorit'])->name('addfavorit');

// CART COUNT
Route::get('load-cart-data', [KeranjangController::class, 'cartcount'])->name('cartcount');

// CART FAVORIT
Route::get('load-wishlist-data', [FavoritController::class, 'favoritcount'])->name('favoritcount');

// ORDER COUNT
Route::get('load-order-data', [CheckoutController::class, 'ordercount'])->name('ordercount');

// REMOVE CART LIST
Route::post('delete-cart-item', [KeranjangController::class, 'deleteproduk'])->name('deletecart');

// REMOVE FAVORIT LIST
Route::post('delete-favorit-item', [FavoritController::class, 'deleteproduk'])->name('deletefavorit');

// UPDATE CART
Route::post('update-cart', [KeranjangController::class, 'updatecart'])->name('updatecart');

// VIEW ALL PRODUCT
Route::get('semua-produk', [LandingController::class, 'semuaproduk'])->name('semuaproduk');

// DETAIL PRODUK
Route::get('detail-produk/{slug}', [LandingController::class, 'detail'])->name('detail.produk');

// VIEW ALL PRODUCT
Route::get('semua-kategori', [LandingController::class, 'semuakategori'])->name('semuakategori');

// DETAIL PRODUK
Route::get('detail-kategori/{slug}', [LandingController::class, 'detailkategori'])->name('detail.kategori');

// SEARCH PRODUK HEADER 
Route::get('produk-list', [LandingController::class, 'search'])->name('search');
Route::post('searchproduk', [LandingController::class, 'searchproduk'])->name('searchproduk');

Auth::routes(['verify' => true]);

Route::middleware('auth', 'verified')->group(function () {
    // ROUTE CART LIST
    Route::get('cart', [KeranjangController::class, 'cartview'])->name('cart.view');

    // ROUTE FAVORIT LIST
    Route::get('favorit', [FavoritController::class, 'favoritview'])->name('favorit.view');

    // ROUTE CHECKOUT
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    // ROUTE PLACE ORDER
    Route::post('place-order', [CheckoutController::class, 'placeorder'])->name('placeorder');

    // ROUTE CEK ORDER
    Route::get('my-orders', [CheckoutController::class, 'myorder'])->name('myorder.index');

    // ROUTE VIEW ORDER DETAIL BAYAR
    Route::get('detail-bayar/{id}', [CheckoutController::class, 'orderbayar'])->name('orderbayar');

    // ROUTE VIEW ORDER DETAIL HISTORY
    Route::get('history-order/{id}', [CheckoutController::class, 'historyorder'])->name('historyorder');

    // ROUTE ADD RATING
    Route::post('add-rating', [RatingController::class, 'addrating'])->name('rating');

    // ROUTE SETTING PROFILE
    Route::get('setting-profile', [LandingController::class, 'settingprofile'])->name('settingprofile');
    Route::post('update-password', [LandingController::class, 'updatepassword'])->name('updatepassword');
    Route::post('update-data', [LandingController::class, 'updatedata'])->name('updatedata');
});



Route::middleware(['has.role'])->middleware('auth', 'verified')->group(function () {
    // ROUTE ADMIN
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ROUTE KATEGORI PRODUK
    Route::get('kategori-produk',  [KategoriProdukController::class, 'index'])->name('kategori-produk.index');
    Route::post('kategori-produk',  [KategoriProdukController::class, 'store'])->name('kategori-produk.store');
    Route::get('kategori-produk/{id}/edit',  [KategoriProdukController::class, 'edit'])->name('kategori-produk.edit');
    Route::put('kategori-produk/{id}/update',  [KategoriProdukController::class, 'update'])->name('kategori-produk.update');
    Route::get('kategori-produk/destroy/{id}',  [KategoriProdukController::class, 'destroy'])->name('kategori-produk.destroy');

    // ROUTE KATEGORI PRODUK
    Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('produk/show/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('produk/{id}/update',  [ProdukController::class, 'update'])->name('produk.update');
    Route::get('produk/{id}/delete-image', [ProdukController::class, 'deleteimage'])->name('images.delete');
    Route::get('produk/{id}/destroy',  [ProdukController::class, 'destroy'])->name('produk.destroy');

    // ROUTE PESANAN
    Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/success', [PesananController::class, 'success'])->name('pesanan.success');
    Route::get('pesanan/{id}/edit', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('pesanan/{id}/update', [PesananController::class, 'update'])->name('pesanan.update');

    // ROUTE PAYMENT
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('payment/{id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::put('payment/{id}/update', [PaymentController::class, 'update'])->name('payment.update');
    Route::get('payment/destroy/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');

    // ROUTE RATINGs
    Route::get('rating', [BackendRatingController::class, 'index'])->name('rating.index');
    Route::get('rating/nonactive', [BackendRatingController::class, 'nonactive'])->name('rating.nonactive');
    Route::get('rating/{id}/edit', [BackendRatingController::class, 'edit'])->name('rating.edit');
    Route::put('rating/{id}/update', [BackendRatingController::class, 'update'])->name('rating.update');

    // ROUTE ROLE
    Route::get('role',  [RoleController::class, 'index'])->name('role.index');
    Route::post('role',  [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{role}/edit',  [RoleController::class, 'edit'])->name('role.edit');
    Route::put('role/{role}/update',  [RoleController::class, 'update'])->name('role.update');
    Route::get('role/destroy/{id}',  [RoleController::class, 'destroy'])->name('role.destroy');

    // ROUTE PERMISSION
    Route::get('permission',  [PermissionController::class, 'index'])->name('permission.index');
    Route::post('permission',  [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/{permission}/edit',  [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('permission/{permission}/update',  [PermissionController::class, 'update'])->name('permission.update');
    Route::get('permission/destroy/{id}',  [PermissionController::class, 'destroy'])->name('permission.destroy');

    // ASSIGN PERMISSION TO ROLE
    Route::get('assignpermission', [AssignPermissionController::class, 'index'])->name('assignpermission.index');
    Route::post('assignpermission', [AssignPermissionController::class, 'store'])->name('assignpermission.store');
    Route::get('assignpermission/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assignpermission.edit');
    Route::put('assignpermission/{role}/update', [AssignPermissionController::class, 'update'])->name('assignpermission.update');

    // ASSIGN ROLE TO USER
    Route::get('assignrole', [AssignRoleController::class, 'index'])->name('assignrole.index');
    Route::post('assignrole', [AssignRoleController::class, 'store'])->name('assignrole.store');
    Route::get('assignrole/{user}/edit', [AssignRoleController::class, 'edit'])->name('assignrole.edit');
    Route::put('assignrole/{user}/update', [AssignRoleController::class, 'update'])->name('assignrole.update');

    // ROUTE MANAJEMEN USER
    Route::get('user', [ManajemenUsersController::class, 'index'])->name('user.index');
    Route::get('user/change-password/{id}/edit', [ManajemenUsersController::class, 'change_password'])->name('change-password');
    Route::put('user/change-password/{id}/edit', [ManajemenUsersController::class, 'update_password'])->name('update-password');
});


Route::get('auth/google', 'redirectToGoogle')->name('auth.google');

