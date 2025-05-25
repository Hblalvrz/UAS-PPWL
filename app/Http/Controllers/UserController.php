<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua user
        $users = User::all();

        // Kirim ke komponen React bernama 'Users/Index'
        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }
}
