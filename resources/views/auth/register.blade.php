@extends('layouts.app')
@section('title', 'Registro')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Crear Cuenta</h2>

    <form method="POST" action="{{ route('auth.register.post') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Nombre" class="w-full p-2 border rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded" required>
        <input type="password" name="password" placeholder="Contraseña" class="w-full p-2 border rounded" required>
        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Registrarse</button>
    </form>

    <p class="text-center mt-4">
        ¿Ya tienes cuenta? <a href="{{ route('auth.login') }}" class="text-blue-500 hover:underline">Inicia sesión</a>
    </p>
</div>
@endsection
