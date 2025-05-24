<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get(); 
        return view('pengguna.index', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user', 
    ]);

    return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
}

// Di PenggunaController.php
public function getTotalPengguna()
{
    return User::where('role', 'user')->count();
}
    
}
