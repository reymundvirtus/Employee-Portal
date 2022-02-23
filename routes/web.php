<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

//* for landing poge
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/home', [AdminController::class, 'index']);
Route::get('/logout', [AdminController::class, 'index']);

//* for login / logout system
Route::get('/login', [LoginController::class, 'index'])->name('login'); //? login user page
Route::post('/login', [LoginController::class, 'store']); //? validate if the user has account
Route::post('/register', [RegisterController::class, 'store'])->name('register'); //? store in db after signup
Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); //? logout the user
Route::get('/admin', [AdminController::class, 'index'])->name('admin'); //? go to dashboard
Route::get('/manager', [ManagerController::class, 'index'])->name('manager'); //? go to dashboard
Route::get('/cashier', [CashierController::class, 'index'])->name('cashier'); //? go to dashboard

//* for crud operation
Route::get('/users', [AdminController::class, 'retrieve_data']); //? for retrieve data to render in index
Route::post('/update_data', [AdminController::class, 'update_data']); //? update data
Route::post('/delete_data', [AdminController::class, 'delete_data']); //? delete a data
Route::get('/data_count', [AdminController::class, 'count_data']); //? data count