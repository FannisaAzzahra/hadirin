<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}