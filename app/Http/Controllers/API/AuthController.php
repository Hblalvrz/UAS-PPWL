<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'user_type' => 'required|in:customer,laundry_providers'
        ],
        [
        'name.unique' => 'Username telah digunakan, silahkan pilih username lain.',
        'password' => 'Password harus memiliki minimal atau lebih dari 8 karakter.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address'=> $request->address,
        ]);

        // Assign role sesuai pilihan user
        $user->assignRole($request->user_type);
        if ($user){
            return redirect()->route('dashboard.index')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return back()->woth('error', 'Registrasi gagal, silahkan coba lagi');
        }
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
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

    // Redirect ke dashboard setelah login sukses
    return redirect()->intended('/dashboard/index');
}


    // Logout (API)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
