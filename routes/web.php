<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollegeFeesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    if (auth('web')->check()) {
        return redirect()->route('dashboard');
    }
    if (auth('students')->check()) {
        return redirect()->route('users.home');
    }
    return redirect()->route('login_users');
})->name('main');


Route::get('/login_user', [AuthController::class, 'User'])->name('login_users');
Route::post('/login_user', [AuthController::class, 'Authenticate_User'])->name('user.auth');

Route::get('/login_admin', [AuthController::class, 'Admin'])->name('login_admin');
Route::post('/login_admin', [AuthController::class, 'Authenticate_Admin'])->name('admin.auth');
Route::post('/populate', [AuthController::class, 'StoreAdmin'])->name('admin.populate');
Route::get('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/register', [AuthController::class, 'Store'])->name('register.store');
Route::get('/register', [AuthController::class, 'Register'])->name('register');

Route::group(['middleware' => 'auth:students'], function () {
    Route::get('/home', [UsersController::class, 'Index'])->name('users.home');
    Route::get('/home/payform/{id}', [UsersController::class, 'PayForm'])->name('fees.payform');
    Route::put('/home/payform/update/{fees}', [UsersController::class, 'PayFormUpdate'])->name('fees.payformupdate');
    Route::post('/logout_user', [AuthController::class, 'LogoutUser'])->name('logout.user');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/admin', [DashboardController::class, 'Index'])->name('dashboard');

    Route::get('/admin/course', [CourseController::class, 'Index'])->name('course');
    Route::get('/admin/course/add', [CourseController::class, 'Add'])->name('course.add');
    Route::post('/admin/course/add', [CourseController::class, 'Store'])->name('course.store');
    Route::get('/admin/course/edit/{id}', [CourseController::class, 'Edit'])->name('course.edit');
    Route::put('/admin/course/update/{course}', [CourseController::class, 'Update'])->name('course.update');
    Route::delete('/admin/course/delete/{id}', [CourseController::class, 'Destroy'])->name('course.destroy');

    Route::get('/admin/users', [UsersController::class, 'Show'])->name('users');

    Route::get('/admin/college_fee', [FeesController::class, 'Index'])->name('fees');

    Route::get('/admin/college_fee/add', [FeesController::class, 'Add'])->name('fees.add');
    Route::post('/admin/college_fee/add', [FeesController::class, 'Store'])->name('fees.store');
    Route::get('/admin/college_fee/edit/{id}', [FeesController::class, 'Edit'])->name('fees.edit');
    Route::put('/admin/college_fee/update/{fees}', [FeesController::class, 'Update'])->name('fees.update');
    Route::delete('/admin/college_fee/delete/{id}', [FeesController::class, 'Destroy'])->name('fees.destroy');

    Route::get('/admin/college_fee/payment/{id}', [FeesController::class, 'Payment'])->name('fees.payment');
    Route::put('/admin/college_fee/payment/update/{fees}', [FeesController::class, 'PaymentUpdate'])->name('fees.paymentupdate');

    Route::post('/logout_admin', [AuthController::class, 'LogoutAdmin'])->name('logout.admin');
});
