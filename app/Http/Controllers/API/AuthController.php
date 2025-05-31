<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('login.auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:users,name',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|string|max:15',
                'address' => 'required|string',
                'user_type' => 'required|in:customer,laundry_providers'
            ],
            [
                'name.unique' => 'Username telah digunakan, silahkan pilih username lain.',
                'password' => 'Password harus memiliki minimal atau lebih dari 8 karakter.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Assign role sesuai pilihan user
        $user->assignRole($request->user_type);

        if ($user) {
            return redirect()->view('login.auth.login')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return back()->with('error', 'Registrasi gagal, silahkan coba lagi');
        }
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('login.auth.login');
    }

    // Proses login (API)
    public function login(Request $request)
    {
        $credentials = $request->validate([

            'name' => 'required', // atau 'username' jika pakai username

            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {

            return back()->withErrors(['name' => 'Username atau password salah.']);
        }

        $request->session()->regenerate();

        if (Auth::user()->hasRole('laundry_providers')) {
            return redirect()->intended('/laundry/dashboard');
        } else {
            // Diasumsikan role lainnya adalah customer
            return redirect()->intended('/customer/dashboard');
        }
    }

    // Logout (API)
    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
