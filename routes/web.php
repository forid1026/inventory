<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\StockReportController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });


    // Supplier All Route
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
        Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
        Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
        Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
    });

    // Customer All Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/all', 'customerAll')->name('customer.all');
        Route::get('/customer/add', 'customerAdd')->name('customer.add');
        Route::post('/customer/store', 'customerStore')->name('customer.store');
        Route::get('/customer/edit/{id}', 'customerEdit')->name('customer.edit');
        Route::post('/customer/update', 'customerUpdate')->name('customer.update');
        Route::get('/customer/delete/{id}', 'customerDelete')->name('customer.delete');
    });

    // Unit All Route
    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit/all', 'unitAll')->name('unit.all');
        Route::get('/unit/add', 'unitAdd')->name('unit.add');
        Route::post('/unit/store', 'unitStore')->name('unit.store');
        Route::get('/unit/edit/{id}', 'unitEdit')->name('unit.edit');
        Route::post('/unit/update', 'unitUpdate')->name('unit.update');
        Route::get('/unit/delete/{id}', 'unitDelete')->name('unit.delete');
    });

    // Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/all', 'categoryAll')->name('category.all');
        Route::get('/category/add', 'categoryAdd')->name('category.add');
        Route::post('/category/store', 'categoryStore')->name('category.store');
        Route::get('/category/edit/{id}', 'categoryEdit')->name('category.edit');
        Route::post('/category/update', 'categoryUpdate')->name('category.update');
        Route::get('/category/delete/{id}', 'categoryDelete')->name('category.delete');
    });

    // Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/all', 'productAll')->name('product.all');
        Route::get('/product/add', 'productAdd')->name('product.add');
        Route::post('/product/store', 'productStore')->name('product.store');
        Route::get('/product/edit/{id}', 'productEdit')->name('product.edit');
        Route::post('/product/update', 'productUpdate')->name('product.update');
        Route::get('/product/delete/{id}', 'productDelete')->name('product.delete');
    });

    // Product All Route
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all');
        Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
        Route::get('/get/category', 'GetCategory')->name('get.category');
        Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
        Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
    });

    // Default All Route
    Route::controller(DefaultController::class)->group(function () {
        Route::get('/get-category', 'GetCategory')->name('get.category');
        Route::get('/get-product', 'GetProduct')->name('get.product');
        Route::get('/get-product-stock', 'GetStock')->name('get.product.stock');
        // Route::post('/purchase/store', 'purchaseStore')->name('purchase.store');
        // Route::get('/purchase/edit/{id}', 'purchaseEdit')->name('purchase.edit');
        // Route::post('/purchase/update', 'purchaseUpdate')->name('purchase.update');
        // Route::get('/purchase/delete/{id}', 'purchaseDelete')->name('purchase.delete');
    });

    // invoice All Route
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all');
        Route::get('/invoice/add', 'InvoiceAdd')->name('invoice.add');
        Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');
        Route::get('/invoice/pending/list', 'InvoicePending')->name('invoice.pending.list');
        Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('invoice.delete');
        Route::get('/invoice/print/{id}', 'InvoicePrint')->name('invoice.print');
        Route::get('/invoice/approve/{id}', 'InvoiceApproved')->name('invoice.approve');
        Route::post('/invoice/approval/{id}', 'ApprovalStore')->name('approval.store');
        // report route
        Route::get('/sales/report', 'DailySalesReport')->name('daily.sales.report');
        Route::get('/sales/report/pdf', 'DailySalesReportPdf')->name('daily.sales.pdf');
    });

    // Stock report All Route
    Route::controller(StockReportController::class)->group(function () {
        Route::get('/stock/report', 'StockReport')->name('stock.report');
        Route::get('/stock/report/print', 'StockReportPrint')->name('stock.report.print');
        Route::post('/due/payment/store', 'DuePaymentStore')->name('due.payment.store');
    });

    // payment All Route
    Route::controller(PaymentController::class)->group(function () {
        Route::get('/due/payment/all', 'DuePaymentAll')->name('due.payment.all');
        Route::get('/due/payment/add', 'DuePaymentAdd')->name('due.payment.add');
        Route::post('/due/payment/store', 'DuePaymentStore')->name('due.payment.store');
    });
});
Route::get('/dashboard', function () {
    return view('users.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/logout', [AdminController::class, 'UserLogout'])->name('user.logout');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin']);

require __DIR__ . '/auth.php';
