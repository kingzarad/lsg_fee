<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeesController;
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
    return view('admin.dashboard');
});


Route::get('/admin', [DashboardController::class, 'Index'])->name('dashboard');
Route::get('/admin/course', [CourseController::class, 'Index'])->name('course');
Route::get('/admin/users', [AuthController::class, 'Index'])->name('users');
Route::get('/admin/college_fee', [FeesController::class, 'Index'])->name('fees');


