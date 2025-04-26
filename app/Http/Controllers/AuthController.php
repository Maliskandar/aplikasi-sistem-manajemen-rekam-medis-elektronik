<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;


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
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed, get the authenticated user
            $user = Auth::user();

            // Store a success message in session
            session()->flash('success', 'Login successful! Welcome ' . $user->username);

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil! Selamat 
                datang Admin Praktik Mandiri Bidan Delima 🖐️');
            } elseif ($user->role === 'bidan') {
                return redirect()->route('bidan.dashboard')->with('success', 'Login berhasil! Selamat 
                datang Bidan 🖐️');
            } elseif ($user->role === 'asisten') {
                return redirect()->route('asisten.dashboard');
            }

            // If authentication fails, redirect back to the login with an error message
            return redirect('/login')->with('error', 'Invalid credentials or role not recognized.');
        }
    }


    // Fungsi logout
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman welcome
        return redirect('/')->with('message', 'Anda berhasil keluar.');
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
            'role' => 'pasien',
        ]);

        // Simpan data ke tabel costumer
        User::create([
            'nama' => $request->nama,
            'info_kontak' => $request->info_kontak,
            'email' => $request->email,
            'id_user' => $user->id, // Relasi dengan user
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('message', 'Registration successful! Please login.');
    }
}