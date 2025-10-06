<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'nullable|string'
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'cliente'
        ]);
        $token = auth()->login($user); // jwt-auth helper
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(Request $r)
    {
        $credentials = $r->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        return response()->json(['token' => $token, 'token_type' => 'bearer', 'expires_in' => auth()->factory()->getTTL() * 60]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
