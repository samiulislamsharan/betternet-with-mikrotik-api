<?php

use App\Http\Controllers\AddComment;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BillingDownload;
use App\Http\Controllers\ChangePackageController;
use App\Http\Controllers\CloseTicket;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisableDueUser;
use App\Http\Controllers\InvoiceDownload;
use App\Http\Controllers\OpenTicket;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDownload;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShowUser;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDisable;
use App\Http\Controllers\UserDownload;
use App\Http\Controllers\UserEnable;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/administration', function () {return view('administration');})->name('administration');

    Route::resource('/packages', PackageController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/billing', BillingController::class);
    Route::resource('/payment', PaymentController::class)->only(['index', 'store']);
    Route::resource('/ticket', TicketController::class);

    Route::get('/payment/create/{param}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    Route::get('/isp', [CompanyController::class, 'edit'])->name('company.edit');
    Route::patch('/isp', [CompanyController::class, 'update'])->name('company.update');

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/change-package/{user}/edit', [ChangePackageController::class, 'edit'])->name('package-change');
    Route::patch('/change-package/{user}', [ChangePackageController::class, 'update'])->name('package-update');
    Route::patch('/user-disable/{user}', UserDisable::class)->name('user.disable');
    Route::patch('/user-enable/{user}', UserEnable::class)->name('user.enable');

    Route::post('/due-user-disable', DisableDueUser::class)->name('due.user.disable');
    Route::get('/log', \App\Http\Controllers\Log::class)->name('log');

    Route::post('/open-ticket/{ticket}', OpenTicket::class)->name('open.ticket');
    Route::post('/close-ticket/{ticket}', CloseTicket::class)->name('close.ticket');
    Route::post('/add-comment', AddComment::class)->name('add.comment');

    Route::get('/user-download', UserDownload::class)->name('user.download');
    Route::get('/billing-download', BillingDownload::class)->name('billing.download');
    Route::get('/payment-download', PaymentDownload::class)->name('payment.download');
    Route::get('/single-download/{user}', ShowUser::class)->name('single.download');
    Route::get('/invoice-download/{row}', InvoiceDownload::class)->name('invoice.download');
});

require __DIR__.'/auth.php';
