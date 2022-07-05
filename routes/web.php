<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as ASController;
use App\Http\Controllers\Admin\BranchAdminController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AdmissionController;

Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return 'clear all ';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('guest:admin')->group(function () {
    Route::get('admin_login', [ASController::class, 'create']);
    Route::post('admin_login', [ASController::class, 'store'])->name('admin_login');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin_dashboard', [AdminController::class, 'index'])->name('admindashboard');
    Route::get('/branch', [BranchAdminController::class, 'index'])->name('branch');
    // Route::get('/branch_create', [BranchAdminController::class, 'create'])->name('branchcreate');
    Route::post('/branch_store', [BranchAdminController::class, 'store'])->name('branchstore');
    Route::get('/branch_edit/{edit_id}', [BranchAdminController::class, 'edit'])->name('branchedit');
    Route::post('/branch_update', [BranchAdminController::class, 'update'])->name('branchupate');
    Route::get('/getdistrict/{state_id}', [BranchAdminController::class, 'getDistrict'])->name('getDistrict');

    // StaffController
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
    Route::get('/staff_website_return', [StaffController::class, 'getWebsite'])->name('staffgetwebsite');
    Route::post('/staff_store', [StaffController::class, 'store'])->name('staffstore');
    Route::get('/staff_edit/{edit_id}', [StaffController::class, 'edit'])->name('staffedit');
    Route::post('/staff_update', [StaffController::class, 'update'])->name('staffupate');

    // AdmissionController
    Route::get('/admission_list', [AdmissionController::class, 'index'])->name('admissionlist');
    Route::get('/admission', [AdmissionController::class, 'create'])->name('admission');
    Route::post('/admission_store', [AdmissionController::class, 'store'])->name('admissionstore');

    Route::get('/admission_edit/{edit_id}', [AdmissionController::class, 'edit'])->name('admissionedit');
    Route::post('/admission_update', [AdmissionController::class, 'update'])->name('admissionupate');
    Route::get('/admission_batch_time/{state_id}', [AdmissionController::class, 'batchTime'])->name('admissionbatchtime');
});
Route::get('admin/logout', [ASController::class, 'destroy'])->name('admin.logout');
