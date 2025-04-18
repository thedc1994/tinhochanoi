<?php
/**
 *File name : auth.php  / Date: 4/17/2025 - 9:27 PM
 *Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;

Route::get('/login', [AuthenticateController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticateController::class, 'login'])->name('login.post');;
Route::post('/logout', [AuthenticateController::class, 'logout'])->name('logout');

Route::get('/register', [AuthenticateController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticateController::class, 'register'])->name('register.post');
