@extends('layouts.app')
@section('title', isset($mascota) ? 'Editar Mascota' : 'Agregar Mascota')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-paw text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">
                {{ isset($mascota) ? 'Editar Mascota' : 'Agregar Nueva Mascota' }}
            </h2>
        </div>
        <p class="text-gray-600">
            {{ isset($mascota) ? 'Actualiza la información de ' . $mascota->nombre : 'Completa el formulario para registrar una nueva mascota' }}
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-{{ isset($mascota) ? 'edit' : 'plus-circle' }} mr-2"></i>
                {{ isset($mascota) ? 'Editar Información' : 'Información de la Mascota' }}
            </h3>
        </div>

        <form action="{{ isset($mascota) ? route('mascotas.update', $mascota->id) : route('mascotas.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @if(isset($mascota)) @method('PUT') @endif

            <!-- Nombre Field -->
            <div class="space-y-2">
                <label for="nombre" class="block text-sm font-medium text-gray-700 flex items-center">
                    <i class="fas fa-signature mr-2 text-purple-500"></i>
                    Nombre de la Mascota
                </label>
                <div class="relative">
                    <input type="text" 
                           id="nombre" 
                           name="nombre" 
                           value="{{ $mascota->nombre ?? old('nombre') }}" 
                           placeholder="Ej: Max, Luna, Toby..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                           required>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-paw text-gray-400"></i>
                    </div>
                </div>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Especie Field -->
            <div class="space-y-2">
                <label for="especie" class="block text-sm font-medium text-gray-700 flex items-center">
                    <i class="fas fa-dna mr-2 text-purple-500"></i>
                    Especie
                </label>
                <div class="relative">
                    <select id="especie" 
                            name="especie" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 appearance-none"
                            required>
                        <option value="">Selecciona una especie</option>
                        <option value="Perro" {{ (isset($mascota) && $mascota->especie == 'Perro') || old('especie') == 'Perro' ? 'selected' : '' }}>Perro</option>
                        <option value="Gato" {{ (isset($mascota) && $mascota->especie == 'Gato') || old('especie') == 'Gato' ? 'selected' : '' }}>Gato</option>
                        <option value="Conejo" {{ (isset($mascota) && $mascota->especie == 'Conejo') || old('especie') == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                        <option value="Ave" {{ (isset($mascota) && $mascota->especie == 'Ave') || old('especie') == 'Ave' ? 'selected' : '' }}>Ave</option>
                        <option value="Roedor" {{ (isset($mascota) && $mascota->especie == 'Roedor') || old('especie') == 'Roedor' ? 'selected' : '' }}>Roedor</option>
                        <option value="Reptil" {{ (isset($mascota) && $mascota->especie == 'Reptil') || old('especie') == 'Reptil' ? 'selected' : '' }}>Reptil</option>
                        <option value="Otro" {{ (isset($mascota) && $mascota->especie == 'Otro') || old('especie') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-dna text-gray-400"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
                @error('especie')
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Raza Field -->
            <div class="space-y-2">
                <label for="raza" class="block text-sm font-medium text-gray-700 flex items-center">
                    <i class="fas fa-dog mr-2 text-purple-500"></i>
                    Raza
                </label>
                <div class="relative">
                    <input type="text" 
                           id="raza" 
                           name="raza" 
                           value="{{ $mascota->raza ?? old('raza') }}" 
                           placeholder="Ej: Labrador, Siames, Pastor Alemán..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-dog text-gray-400"></i>
                    </div>
                </div>
                @error('raza')
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Fecha de Nacimiento Field -->
            <div class="space-y-2">
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 flex items-center">
                    <i class="fas fa-birthday-cake mr-2 text-purple-500"></i>
                    Fecha de Nacimiento
                </label>
                <div class="relative">
                    <input type="date" 
                           id="fecha_nacimiento" 
                           name="fecha_nacimiento" 
                           value="{{ $mascota->fecha_nacimiento ?? old('fecha_nacimiento') }}" 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar-alt text-gray-400"></i>
                    </div>
                </div>
                @error('fecha_nacimiento')
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Additional Fields (Optional) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Peso Field -->
                <div class="space-y-2">
                    <label for="peso" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-weight mr-2 text-purple-500"></i>
                        Peso (kg)
                    </label>
                    <div class="relative">
                        <input type="number" 
                               id="peso" 
                               name="peso" 
                               value="{{ $mascota->peso ?? old('peso') }}" 
                               placeholder="Ej: 5.2" 
                               step="0.1"
                               min="0"
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-weight text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Color Field -->
                <div class="space-y-2">
                    <label for="color" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-palette mr-2 text-purple-500"></i>
                        Color
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="color" 
                               name="color" 
                               value="{{ $mascota->color ?? old('color') }}" 
                               placeholder="Ej: Negro, Blanco, Marrón..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-palette text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notas Field -->
            <div class="space-y-2">
                <label for="notas" class="block text-sm font-medium text-gray-700 flex items-center">
                    <i class="fas fa-sticky-note mr-2 text-purple-500"></i>
                    Notas Adicionales
                </label>
                <textarea id="notas" 
                          name="notas" 
                          rows="3" 
                          placeholder="Información adicional sobre la mascota (alergias, comportamientos especiales, etc.)"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">{{ $mascota->notas ?? old('notas') }}</textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-{{ isset($mascota) ? 'save' : 'plus-circle' }} mr-2"></i>
                    {{ isset($mascota) ? 'Actualizar Mascota' : 'Crear Mascota' }}
                </button>
                
                <a href="{{ route('mascotas.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-all duration-200 border border-gray-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al Listado
                </a>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-8 bg-blue-50 rounded-xl p-6 border border-blue-200">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 text-xl mt-1"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium text-blue-800">Información importante</h3>
                <div class="mt-2 text-blue-700">
                    <p class="text-sm">
                        • Todos los campos marcados con <span class="text-red-500">*</span> son obligatorios.<br>
                        • La fecha de nacimiento nos ayuda a proporcionar cuidados apropiados para la edad de tu mascota.<br>
                        • La información sobre raza y peso es útil para personalizar recomendaciones de salud.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Custom focus styles */
    input:focus, select:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    /* Custom select arrow */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    /* Animation for form elements */
    .form-field {
        transition: all 0.3s ease;
    }
    
    .form-field:focus-within {
        transform: translateY(-2px);
    }
</style>

<script>
    // Add dynamic behavior
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to form fields on focus
        const formFields = document.querySelectorAll('input, select, textarea');
        formFields.forEach(field => {
            const parent = field.closest('.relative') || field.parentElement;
            if (parent) {
                parent.classList.add('form-field');
            }
            
            field.addEventListener('focus', function() {
                if (parent) {
                    parent.classList.add('ring-2', 'ring-purple-300');
                }
            });
            
            field.addEventListener('blur', function() {
                if (parent) {
                    parent.classList.remove('ring-2', 'ring-purple-300');
                }
            });
        });
        
        // Auto-calculate age based on birth date
        const fechaNacimiento = document.getElementById('fecha_nacimiento');
        if (fechaNacimiento) {
            fechaNacimiento.addEventListener('change', function() {
                if (this.value) {
                    const birthDate = new Date(this.value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    // You could display this somewhere if needed
                    console.log(`Edad aproximada: ${age} años`);
                }
            });
        }
    });
</script>
@endsection