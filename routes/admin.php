<?php
/**
 *File name : admin.php  / Date: 4/20/2025 - 12:18 AM
 *Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth']) // Nếu cần phân quyền có thể thêm middleware role tại đây
->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // Các route admin khác ở đây sau này (products, orders, users,...)
    });
