<?php
/**
 * File name : AuthenticateController.php  / Date:  - 11:03 PM
 * Code Owner: Tke / Phone: 0367313134 / Email: thedc.it.94@gmail.com
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // cần có password_confirmation
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user); // Đăng nhập ngay sau khi đăng ký (nếu cần)

        return redirect()->intended('/dashboard');
    }
}
