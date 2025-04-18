<?php

use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

require base_path('routes/auth.php');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload-image', [ImageUploadController::class, 'showForm']);
Route::post('/upload-image', [ImageUploadController::class, 'upload']);

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return '✅ Kết nối DB thành công!';
    } catch (\Exception $e) {
        return '❌ Kết nối thất bại: ' . $e->getMessage();
    }
});
