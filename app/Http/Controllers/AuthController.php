<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function login()
    {
        return view('login');
    }

    // Proses login
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Cek role user setelah berhasil login
            if (Auth::user()->role !== 'admin') {
                Auth::logout(); // Logout langsung
                $request->session()->invalidate();
                $request->session()->regenerateToken();
    
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki akses ke sistem.',
                ]);
            }
    
            return redirect()->route('admin');
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }   
    
    

    // Proses register

      
public function register()
{
    return view('register'); 
}

    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


 public function adminDashboard()
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    // Ambil data yang dibutuhkan untuk modal laporan
    $barang = Barang::with('kategori')->get();
    $peminjaman = Peminjaman::with('user', 'barang')->get();
    $pengembalian = Pengembalian::with('peminjaman')->get();

    return view('admin', [
        'totalUsers' => User::where('role', '!=', 'admin')->count(),
        'totalItems' => Barang::count(),
        'activeLoans' => Peminjaman::where('status', 'disetujui')->count(),
        'todayReturns' => Pengembalian::whereDate('tanggal_pengembalian', today())
                                    ->where('status', 'diproses')
                                    ->count(),
        'barang' => $barang,
        'peminjaman' => $peminjaman,
        'pengembalian' => $pengembalian,
    ]);
}

}