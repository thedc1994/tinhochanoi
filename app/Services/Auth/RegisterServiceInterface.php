<?php
/**
 *File name : RegisterServiceInterface.php  / Date: 4/19/2025 - 11:47 PM
 *Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */

namespace App\Services\Auth;

use App\Models\User;

interface RegisterServiceInterface
{
    public function register(array $data): User;
}
