<?php
/**
 *File name : FacebookRegisterService.php  / Date: 4/19/2025 - 11:52 PM
 *Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
namespace App\Services\Auth;

use App\Models\User;

class FacebookRegisterService implements RegisterServiceInterface
{
    public function register(array $data): User
    {
        // TODO: Thêm logic đăng ký qua Facebook tại đây

        // Dummy user trả về tạm để tránh lỗi
        return new User();
    }
}
