<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= API =================
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

        $token = auth()->login($user);

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(Request $r)
    {
        $credentials = $r->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
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

    // ================= WEB =================
    public function showLogin()
    {
        return view('auth.login');
    }
    public function showRegister()
    {
        return view('auth.register');
    }

    public function loginWeb(Request $r)
    {
        $credentials = $r->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return back()->withErrors(['email' => 'Credenciales incorrectas']);
        }

        // Guardar token en cookie por 1 día
        return redirect('/mascotas')->withCookie(cookie('token', $token, 60 * 24));
    }

    public function registerWeb(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'cliente'
        ]);

        $token = auth()->login($user);

        // Guardar token en cookie por 1 día
        return redirect('/mascotas')->withCookie(cookie('token', $token, 60 * 24));
    }

    public function logoutWeb(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect('/')->withCookie(cookie()->forget('token'));
    }
}
