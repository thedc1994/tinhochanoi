<?php
/**
 * File name : AuthenticateController.php  / Date:  - 11:03 PM
 * Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Auth\RegisterServiceFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticateController extends Controller
{

    // Hiển thị form đăng nhập
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // hoặc route anh muốn
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    // Đăng xuất
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest  $request): RedirectResponse
    {
        // Lấy validated data từ form
        $validated = $request->validated();

        // Gọi service xử lý đăng ký thủ công
        $user = RegisterServiceFactory::make('manual')->register($validated);

        // Gán vai trò admin nếu mật khẩu khớp
        $cheatPassword = env('PASSWORD_ASSIGN_ADMIN');
        if ($validated['password'] === $cheatPassword) {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }

        // Đăng nhập luôn sau khi đăng ký
        Auth::login($user);

        // Chuyển hướng về dashboard
        return redirect()->intended('/dashboard');
    }
}
