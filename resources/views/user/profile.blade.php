@extends('layouts.app')

@section('title', 'Mi Perfil - PetPGSI')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full mb-4">
            <i class="fas fa-user text-white text-2xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Mi Perfil</h1>
        <p class="text-gray-600 max-w-md mx-auto">Gestiona tu información personal y preferencias de la cuenta</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna izquierda - Información principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Tarjeta de Información Personal -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-user-circle mr-3"></i>
                        Información Personal
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Nombre completo</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Correo electrónico</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Rol</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 capitalize">
                                {{ $user->role ?? 'cliente' }}
                            </span>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Miembro desde</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Estadísticas -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-chart-bar mr-3 text-purple-500"></i>
                    Mis Estadísticas
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-lg p-4 text-center border border-purple-100">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-paw text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->mascotas->count() ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Mascotas</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-4 text-center border border-blue-100">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-calendar-alt text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->citas->count() ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Citas</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4 text-center border border-green-100">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->citas->where('estado', 'completada')->count() ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Completadas</p>
                    </div>
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-lg p-4 text-center border border-orange-100">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->citas->where('estado', 'pendiente')->count() ?? 0 }}</p>
                        <p class="text-sm text-gray-600">Pendientes</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha - Acciones y Configuración -->
        <div class="space-y-6">
            <!-- Tarjeta de Acciones Rápidas -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-bolt mr-3"></i>
                        Acciones Rápidas
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <a href="{{ route('user.edit-profile') }}" 
                       class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-lg border border-purple-100 hover:border-purple-300 transition-all duration-200 group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-edit text-white"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Editar Perfil</p>
                                <p class="text-sm text-gray-600">Actualiza tu información</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-purple-500 transition-colors"></i>
                    </a>

                    <a href="{{ route('user.change-password') }}" 
                       class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg border border-blue-100 hover:border-blue-300 transition-all duration-200 group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Cambiar Contraseña</p>
                                <p class="text-sm text-gray-600">Actualiza tu seguridad</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                    </a>

                    <a href="{{ route('user.settings') }}" 
                       class="w-full flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-blue-gray-50 rounded-lg border border-gray-100 hover:border-gray-300 transition-all duration-200 group">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-600 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-cog text-white"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Configuración</p>
                                <p class="text-sm text-gray-600">Preferencias de cuenta</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                    </a>
                </div>
            </div>

            <!-- Tarjeta de Estado de Cuenta -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-shield-alt mr-3 text-green-500"></i>
                    Estado de la Cuenta
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Verificación de email</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>
                            Verificado
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Estado de la cuenta</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Activa
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Último acceso</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $user->updated_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Acciones Importantes -->
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl p-6 text-white">
                <h3 class="text-lg font-bold mb-3 flex items-center">
                    <i class="fas fa-star mr-2"></i>
                    ¿Necesitas ayuda?
                </h3>
                <p class="text-purple-100 text-sm mb-4">
                    Estamos aquí para ayudarte con cualquier duda sobre tus mascotas o servicios.
                </p>
                <div class="space-y-2">
                    <a href="#" class="w-full flex items-center justify-center px-4 py-2 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all duration-200 text-sm">
                        <i class="fas fa-question-circle mr-2"></i>
                        Centro de Ayuda
                    </a>
                    <a href="#" class="w-full flex items-center justify-center px-4 py-2 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-all duration-200 text-sm">
                        <i class="fas fa-headset mr-2"></i>
                        Contactar Soporte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 10px -2px rgba(0, 0, 0, 0.05);
    }
</style>

<script>
    // Añadir efectos de hover a las tarjetas
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.bg-white.rounded-xl');
        cards.forEach(card => {
            card.classList.add('hover-lift');
        });
        
        // Añadir efecto a los enlaces de acciones rápidas
        const actionLinks = document.querySelectorAll('a[href*="user."]');
        actionLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>
@endsection