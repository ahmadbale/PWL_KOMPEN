<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        if (Auth::guard('personil')->check() || Auth::guard('mahasiswa')->check()) {
            return redirect('/login');
        }
        return view('auth.login');
    }
    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');
    
            if (Auth::guard('mahasiswa')->attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil sebagai Mahasiswa',
                    'redirect' => url('/') // Redirect ke halaman mahasiswa
                ]);
            }
    
            if (Auth::guard('personil')->attempt($credentials)) {
                $user = Auth::guard('personil')->user();
    
                if ($user->level->kode_level === 'ADM') {
                    return response()->json([
                        'status' => true,
                        'message' => 'Login Berhasil sebagai Admin',
                        'redirect' => url('/dahsboardadm') // Redirect ke halaman admin
                    ]);
                } elseif ($user->level->kode_level === 'DSN') {
                    return response()->json([
                        'status' => true,
                        'message' => 'Login Berhasil sebagai Dosen',
                        'redirect' => url('/dahsboarddsn') // Redirect ke halaman dosen
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Level pengguna tidak dikenali',
                    ], 403); // Forbidden jika level tidak dikenali
                }
            }
    
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal. Username atau password salah.'
            ]);
        }
    
        return redirect('login');
    }
    

    public function logout(Request $request)
    {
        // Pastikan auth guard yang digunakan sesuai, misalnya 'web' atau 'admin'
        Auth::logout();
        
        // Hapus semua session yang ada
        $request->session()->flush();
    
        // Invalidate session dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login
        return redirect()->route('login'); // atau gunakan redirect('login')
    }
    
}
