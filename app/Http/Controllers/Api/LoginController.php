<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function mahasiswaLogin(Request $request)
    {
        return $this->login($request, 'api_mahasiswa');
    }

    public function personilLogin(Request $request)
    {
        return $this->login($request, 'api_personil');
    }

    private function login(Request $request, $guard)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ambil kredensial
        $credentials = $request->only('username', 'password');

        // Autentikasi menggunakan guard yang diberikan
        if (!$token = auth()->guard($guard)->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau Password Anda salah',
            ], 401);
        }

        // Return response sukses
        return response()->json([
            'success' => true,
            'user' => auth()->guard($guard)->user(),
            'token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth($guard)->factory()->getTTL() * 60, // Waktu kedaluwarsa token dalam detik
        ], 200);
    }
}
