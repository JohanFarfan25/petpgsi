@extends('layouts.app')
@section('title', isset($servicio) ? 'Editar Servicio' : 'Agregar Servicio')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            {{ isset($servicio) ? 'Editar Servicio' : 'Agregar Servicio' }}
        </h1>
        <p class="text-gray-600">
            {{ isset($servicio) ? 'Actualiza la información del servicio' : 'Completa los datos del nuevo servicio' }}
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
        <form action="{{ isset($servicio) ? route('servicios.update', $servicio->id) : route('servicios.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($servicio)) @method('PUT') @endif

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del servicio *
                </label>
                <input type="text" 
                       id="nombre" 
                       name="nombre" 
                       value="{{ $servicio->nombre ?? old('nombre') }}" 
                       placeholder="Ej: Baño y secado, Corte de uñas, Consulta veterinaria..."
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       required>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Duración -->
            <div>
                <label for="duracion_minutos" class="block text-sm font-medium text-gray-700 mb-2">
                    Duración (minutos) *
                </label>
                <input type="number" 
                       id="duracion_minutos" 
                       name="duracion_minutos" 
                       value="{{ $servicio->duracion_minutos ?? old('duracion_minutos') }}" 
                       placeholder="Ej: 30, 60, 90..."
                       min="1"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                       required>
                @error('duracion_minutos')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Precio -->
            <div>
                <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">
                    Precio *
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500">$</span>
                    </div>
                    <input type="number" 
                           id="precio" 
                           name="precio" 
                           value="{{ $servicio->precio ?? old('precio') }}" 
                           placeholder="0.00"
                           step="0.01"
                           min="0"
                           class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           required>
                </div>
                @error('precio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción (si existe en el modelo) -->
            @if(isset($servicio) && property_exists($servicio, 'descripcion'))
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción
                </label>
                <textarea id="descripcion" 
                          name="descripcion" 
                          rows="3" 
                          placeholder="Describe el servicio..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ $servicio->descripcion ?? old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    {{ isset($servicio) ? 'Actualizar Servicio' : 'Crear Servicio' }}
                </button>
                
                <a href="{{ route('servicios.index') }}" 
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
            La duración y precio ayudan a gestionar mejor las citas y facturación.
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Formatear automáticamente el precio
        const precioInput = document.getElementById('precio');
        if (precioInput) {
            precioInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        }

        // Validación de duración mínima
        const duracionInput = document.getElementById('duracion_minutos');
        if (duracionInput) {
            duracionInput.addEventListener('blur', function() {
                if (this.value && this.value < 1) {
                    this.value = 1;
                }
            });
        }
    });
</script>
@endsection