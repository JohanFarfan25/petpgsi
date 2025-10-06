@extends('layouts.app')

@section('title', 'Configuración - PetPGSI')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Configuración</h1>
            <p class="text-blue-100">Personaliza tu experiencia en PetPGSI</p>
        </div>

        <div class="p-6">
            <form action="{{ route('user.update-settings') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Notificaciones -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notificaciones</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="checkbox" name="notifications_email" id="notifications_email" 
                                       value="1" {{ ($user->settings['notifications_email'] ?? true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="notifications_email" class="ml-3 block text-sm font-medium text-gray-700">
                                    Recibir notificaciones por correo electrónico
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="notifications_sms" id="notifications_sms" 
                                       value="1" {{ ($user->settings['notifications_sms'] ?? false) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="notifications_sms" class="ml-3 block text-sm font-medium text-gray-700">
                                    Recibir notificaciones por SMS
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Preferencias -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Preferencias</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="language" class="block text-sm font-medium text-gray-700">Idioma</label>
                                <select name="language" id="language" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="es" {{ ($user->settings['language'] ?? 'es') == 'es' ? 'selected' : '' }}>Español</option>
                                    <option value="en" {{ ($user->settings['language'] ?? 'es') == 'en' ? 'selected' : '' }}>English</option>
                                </select>
                            </div>

                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700">Zona horaria</label>
                                <select name="timezone" id="timezone" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="America/Bogota" {{ ($user->settings['timezone'] ?? 'America/Bogota') == 'America/Bogota' ? 'selected' : '' }}>Colombia (Bogotá)</option>
                                    <option value="America/Mexico_City" {{ ($user->settings['timezone'] ?? 'America/Bogota') == 'America/Mexico_City' ? 'selected' : '' }}>México</option>
                                    <option value="America/New_York" {{ ($user->settings['timezone'] ?? 'America/Bogota') == 'America/New_York' ? 'selected' : '' }}>EST (New York)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('user.profile') }}" 
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Configuración
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection