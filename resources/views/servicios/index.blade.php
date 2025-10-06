@extends('layouts.app')
@section('title', 'Servicios')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-3xl font-bold text-gray-900">Servicios</h1>
            <p class="text-gray-600 mt-2">Gestiona los servicios disponibles para las mascotas</p>
        </div>
        <a href="{{ route('servicios.create') }}" 
           class="bg-blue-600 text-white px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Agregar Servicio
        </a>
    </div>

    @if($servicios->count() > 0)
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($servicios as $servicio)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="p-6">
                    <!-- Service Header -->
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $servicio->nombre }}</h3>
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                            ${{ number_format($servicio->precio, 2) }}
                        </span>
                    </div>
                    
                    <!-- Description -->
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ $servicio->descripcion }}
                    </p>
                    
                    <!-- Actions -->
                    <div class="flex space-x-3">
                        <a href="{{ route('servicios.edit', $servicio->id) }}" 
                           class="flex-1 bg-yellow-500 text-white text-center py-2 px-4 rounded-lg font-medium hover:bg-yellow-600 transition-colors">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('servicios.destroy', $servicio->id) }}" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este servicio?')"
                                    class="w-full bg-red-500 text-white py-2 px-4 rounded-lg font-medium hover:bg-red-600 transition-colors">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No hay servicios registrados</h3>
                <p class="text-gray-600 mb-6">Comienza agregando tu primer servicio para ofrecerlo a las mascotas.</p>
                <a href="{{ route('servicios.create') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Agregar Primer Servicio
                </a>
            </div>
        </div>
    @endif
</div>
@endsection