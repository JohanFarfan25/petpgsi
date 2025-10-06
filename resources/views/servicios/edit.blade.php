@extends('layouts.app')
@section('title', isset($servicio) ? 'Editar Servicio' : 'Agregar Servicio')

@section('content')
<div class="max-w-md mx-auto py-8 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">
            {{ isset($servicio) ? 'Editar Servicio' : 'Nuevo Servicio' }}
        </h1>
        <p class="text-gray-600 text-sm">
            {{ isset($servicio) ? 'Modifica la información del servicio' : 'Completa los datos del servicio' }}
        </p>
    </div>

    <!-- Form -->
    <form action="{{ isset($servicio) ? route('servicios.update', $servicio->id) : route('servicios.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($servicio)) @method('PUT') @endif

        <div class="space-y-4">
            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" 
                       name="nombre" 
                       value="{{ $servicio->nombre ?? old('nombre') }}" 
                       placeholder="Nombre del servicio"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- Duración -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Duración (minutos)</label>
                <input type="number" 
                       name="duracion_minutos" 
                       value="{{ $servicio->duracion_minutos ?? old('duracion_minutos') }}" 
                       placeholder="30"
                       min="1"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <!-- Precio -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                <input type="number" 
                       name="precio" 
                       value="{{ $servicio->precio ?? old('precio') }}" 
                       placeholder="0.00"
                       step="0.01"
                       min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex gap-3 pt-4">
            <button type="submit" 
                    class="flex-1 bg-blue-600 text-white py-2 px-4 rounded font-medium hover:bg-blue-700 transition-colors">
                {{ isset($servicio) ? 'Actualizar' : 'Crear' }}
            </button>
            
            <a href="{{ route('servicios.index') }}" 
               class="bg-gray-200 text-gray-800 py-2 px-4 rounded font-medium hover:bg-gray-300 transition-colors">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection