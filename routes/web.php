<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |---------------- Profile ----------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |---------------- Students (Payment Module) ----------------
    */
    Route::resource('students', StudentController::class);

    Route::get('students/{student}/pay-fee', [StudentController::class, 'payFee'])
        ->name('students.payFee');

    Route::post('students/{student}/pay-fee', [StudentController::class, 'storeFee'])
        ->name('students.payFee.store');

    Route::get('students/{student}/fee-history', [StudentController::class, 'feeHistory'])
        ->name('students.feeHistory');

    Route::get('fee/{fee}/receipt', [StudentController::class, 'receipt'])
        ->name('students.receipt');

    /*
    |---------------- Razorpay ----------------
    */
    Route::post('/razorpay/payment', [StudentController::class, 'razorpayPayment'])
        ->name('razorpay.payment');

    Route::post('/razorpay/success', [StudentController::class, 'razorpaySuccess'])
        ->name('razorpay.success');

    /*
    |---------------- Project Module (User) ----------------
    */
    Route::resource('projects', ProjectController::class);
});


/*
|--------------------------------------------------------------------------
| Admin Only Routes (IMPORTANT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::post('/projects/{project}/approve', [ProjectController::class, 'approve'])
        ->name('projects.approve');

    Route::post('/projects/{project}/reject', [ProjectController::class, 'reject'])
        ->name('projects.reject');
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';