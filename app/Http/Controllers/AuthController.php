<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validating the input
        $request->validate([
            'username' => 'required|alpha_num',
            'password' => 'required|min:8',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed, get the authenticated user
            $user = Auth::user();

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'customer') {
                return redirect()->route('customer.dashboard');
            }
        }

        // If authentication fails, redirect back to the login with an error message
        return redirect('/login')->with('error', 'Invalid credentials or role not recognized.');
    }


    // Fungsi logout
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login')->with('message', 'You have successfully logged out.');
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses registrasi customer
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'info_kontak' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email',
            'username' => 'required|alpha_num|unique:users,username',
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
        ]);

        // Simpan data ke tabel users
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        // Simpan data ke tabel costumer
        Customer::create([
            'nama' => $request->nama,
            'info_kontak' => $request->info_kontak,
            'email' => $request->email,
            'id_customer' => $user->id, // Relasi dengan user
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('message', 'Registration successful! Please login.');
    }
}