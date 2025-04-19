<?php
/**
 *File name : ManualRegisterService.php  / Date: 4/19/2025 - 11:47 PM
 *Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManualRegisterService implements RegisterServiceInterface
{
    public function register(array $data): User
    {
        return User::create([
            'first_name' => $data['first-name'],
            'last_name'  => $data['last-name'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,
            'address'    => $data['address'] ?? null,
            'avatar'     => $data['avatar'] ?? null,
            'status'     => 1,
            'password'   => Hash::make($data['password']),
        ]);
    }
}
