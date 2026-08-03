<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        // 1. Pastikan user harus login
        $this->middleware('auth');

        // 2. Tambahan: Hanya boleh diakses email tertentu (Contoh: Admin)
        $this->middleware(function ($request, $next) {
            if (Auth::user()->email !== 'admin@perusahaan.com') {
                // Jika bukan admin, tendang ke dashboard dengan pesan error
                return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users')->with('success', 'User berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/users')->with('success', 'User berhasil dihapus!');
    }
}
