@extends('layouts.app')
@section('title', isset($mascota) ? 'Editar Mascota' : 'Agregar Mascota')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            {{ isset($mascota) ? 'Editar Mascota' : 'Agregar Nueva Mascota' }}
        </h1>
        <p class="text-gray-600">
            {{ isset($mascota) ? 'Actualiza la información de tu mascota' : 'Completa los datos de tu mascota' }}
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
        <form action="{{ isset($mascota) ? route('mascotas.update', $mascota->id) : route('mascotas.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($mascota)) @method('PUT') @endif

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la mascota *
                </label>
                <input type="text" 
                       id="nombre" 
                       name="nombre" 
                       value="{{ $mascota->nombre ?? old('nombre') }}" 
                       placeholder="Ingresa el nombre de tu mascota"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       required>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Especie -->
            <div>
                <label for="especie" class="block text-sm font-medium text-gray-700 mb-2">
                    Especie *
                </label>
                <select id="especie" 
                        name="especie" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                    <option value="">Selecciona una especie</option>
                    <option value="Perro" {{ (isset($mascota) && $mascota->especie == 'Perro') || old('especie') == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ (isset($mascota) && $mascota->especie == 'Gato') || old('especie') == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Conejo" {{ (isset($mascota) && $mascota->especie == 'Conejo') || old('especie') == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                    <option value="Ave" {{ (isset($mascota) && $mascota->especie == 'Ave') || old('especie') == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ (isset($mascota) && $mascota->especie == 'Otro') || old('especie') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('especie')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Raza -->
            <div>
                <label for="raza" class="block text-sm font-medium text-gray-700 mb-2">
                    Raza
                </label>
                <input type="text" 
                       id="raza" 
                       name="raza" 
                       value="{{ $mascota->raza ?? old('raza') }}" 
                       placeholder="Ej: Labrador, Siames, etc."
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                @error('raza')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Nacimiento -->
            <div>
                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 mb-2">
                    Fecha de Nacimiento
                </label>
                <input type="date" 
                       id="fecha_nacimiento" 
                       name="fecha_nacimiento" 
                       value="{{ $mascota->fecha_nacimiento ?? old('fecha_nacimiento') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                @error('fecha_nacimiento')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Información adicional opcional -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información adicional (opcional)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Peso -->
                    <div>
                        <label for="peso" class="block text-sm font-medium text-gray-700 mb-2">
                            Peso (kg)
                        </label>
                        <input type="number" 
                               id="peso" 
                               name="peso" 
                               value="{{ $mascota->peso ?? old('peso') }}" 
                               placeholder="0.0"
                               step="0.1"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                            Color
                        </label>
                        <input type="text" 
                               id="color" 
                               name="color" 
                               value="{{ $mascota->color ?? old('color') }}" 
                               placeholder="Ej: Negro, Blanco, etc."
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>
                </div>

                <!-- Notas -->
                <div class="mt-4">
                    <label for="notas" class="block text-sm font-medium text-gray-700 mb-2">
                        Notas adicionales
                    </label>
                    <textarea id="notas" 
                              name="notas" 
                              rows="3" 
                              placeholder="Información adicional sobre tu mascota..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ $mascota->notas ?? old('notas') }}</textarea>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    {{ isset($mascota) ? 'Actualizar Mascota' : 'Crear Mascota' }}
                </button>
                
                <a href="{{ route('mascotas.index') }}" 
                   class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- Información de ayuda -->
    <div class="mt-6 bg-blue-50 rounded-lg p-4">
        <p class="text-sm text-blue-800">
            <strong>Nota:</strong> Los campos marcados con * son obligatorios. 
            La información adicional nos ayuda a brindar un mejor servicio a tu mascota.
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cambiar placeholder de raza según especie seleccionada
        const especieSelect = document.getElementById('especie');
        const razaInput = document.getElementById('raza');
        
        if (especieSelect && razaInput) {
            especieSelect.addEventListener('change', function() {
                const especie = this.value;
                const placeholders = {
                    'Perro': 'Ej: Labrador, Pastor Alemán, Bulldog...',
                    'Gato': 'Ej: Siames, Persa, Maine Coon...',
                    'Conejo': 'Ej: Holandés, Angora, Mini Lop...',
                    'Ave': 'Ej: Canario, Perico, Agapornis...',
                    'Otro': 'Especifica la raza o tipo...'
                };
                
                razaInput.placeholder = placeholders[especie] || 'Especifica la raza...';
            });
        }
    });
</script>
@endsection