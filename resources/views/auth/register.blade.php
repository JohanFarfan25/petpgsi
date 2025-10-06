@extends('layouts.app')
@section('title', 'Registro')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-teal-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header con gradiente -->
            <div class="bg-gradient-to-r from-green-600 to-teal-700 px-6 py-8 text-center">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Crear Cuenta</h2>
                <p class="text-green-100">Únete a nuestra comunidad de mascotas</p>
            </div>

            <!-- Formulario -->
            <div class="px-8 py-8">
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <div>
                                <p class="text-red-800 text-sm font-medium">Por favor corrige los siguientes errores:</p>
                                <ul class="text-red-700 text-sm mt-1 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.register.post') }}" class="space-y-6">
                    @csrf

                    <!-- Campo Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre completo
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name') }}"
                                   placeholder="Tu nombre completo" 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   required
                                   autocomplete="name"
                                   autofocus>
                        </div>
                    </div>

                    <!-- Campo Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Correo electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email') }}"
                                   placeholder="tu@email.com" 
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   required
                                   autocomplete="email">
                        </div>
                    </div>

                    <!-- Campo Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   placeholder="••••••••" 
                                   class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   required
                                   autocomplete="new-password">
                            <button type="button" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password-toggle"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            La contraseña debe tener al menos 8 caracteres.
                        </p>
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="terms" 
                               id="terms"
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                               required>
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Acepto los <a href="#" class="text-green-600 hover:text-green-500">términos y condiciones</a>
                        </label>
                    </div>

                    <!-- Botón de enviar -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-600 to-teal-700 text-white py-3 px-4 rounded-lg font-medium hover:from-green-700 hover:to-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg">
                        <i class="fas fa-user-plus mr-2"></i>
                        Crear Cuenta
                    </button>
                </form>

                <!-- Separador -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">¿Ya tienes cuenta?</span>
                        </div>
                    </div>

                    <!-- Enlace a login -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('auth.login') }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Iniciar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="text-center">
            <p class="text-xs text-gray-500">
                Al registrarte, aceptas nuestros 
                <a href="#" class="text-green-600 hover:text-green-500">Términos de servicio</a> 
                y 
                <a href="#" class="text-green-600 hover:text-green-500">Política de privacidad</a>.
            </p>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.remove('fa-eye');
            passwordToggle.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.remove('fa-eye-slash');
            passwordToggle.classList.add('fa-eye');
        }
    }

    // Efecto de focus en los campos
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-green-200', 'rounded-lg');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-green-200', 'rounded-lg');
            });
        });

        // Validación de contraseña en tiempo real
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                if (this.value.length >= 8) {
                    this.classList.add('border-green-300');
                    this.classList.remove('border-red-300');
                } else {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-red-300');
                }
            });
        }

        // Auto-ocultar mensajes de error después de 5 segundos
        setTimeout(function() {
            const errorMessages = document.querySelectorAll('.bg-red-50');
            errorMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s';
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 500);
            });
        }, 5000);
    });
</script>

<style>
    .shadow-lg {
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4), 0 4px 10px -2px rgba(16, 185, 129, 0.2);
    }
</style>
@endsection