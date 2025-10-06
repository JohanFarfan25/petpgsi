@extends('layouts.app')
@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>

    <form method="POST" action="{{ route('auth.login.post') }}" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
        <input type="password" name="password" placeholder="Contraseña" class="w-full p-2 border rounded" required>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Ingresar</button>
    </form>

    <p class="text-center mt-4">
        ¿No tienes cuenta? <a href="{{ route('auth.register') }}" class="text-blue-500 hover:underline">Regístrate</a>
    </p>
</div>
@endsection
