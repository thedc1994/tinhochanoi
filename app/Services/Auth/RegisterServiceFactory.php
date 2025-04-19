<?php
/**
 *File name : RegisterServiceFactory.php  / Date: 4/19/2025 - 11:50 PM
 *Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
namespace App\Services\Auth;

use InvalidArgumentException;

class RegisterServiceFactory
{
    /**
     * Trả về instance phù hợp với loại đăng ký
     */
    public static function make(string $type): RegisterServiceInterface
    {
        return match ($type) {
            'manual'   => app(ManualRegisterService::class),
            'google'   => app(GoogleRegisterService::class),
            'facebook' => app(FacebookRegisterService::class),
            default    => throw new InvalidArgumentException("Unsupported register type: $type")
        };
    }
}
