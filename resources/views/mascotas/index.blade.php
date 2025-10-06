@extends('layouts.app')
@section('title', 'Mis Mascotas')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-paw text-white"></i>
                </div>
                Mis Mascotas
            </h1>
            <p class="text-gray-600 mt-2">Gestiona la información de tus mascotas registradas</p>
        </div>
        <a href="{{ route('mascotas.create') }}" 
           class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <i class="fas fa-plus-circle mr-2"></i>
            Agregar Mascota
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-paw text-lg"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Mascotas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $mascotas->count() }}</p>
                </div>
            </div>
        </div>
        
        <!-- Dynamic Species Cards -->
        @php
            $speciesCount = $mascotas->groupBy('especie')->map->count();
            $colorClasses = [
                'blue' => ['border' => 'border-blue-500', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'icon' => 'dog'],
                'orange' => ['border' => 'border-orange-500', 'bg' => 'bg-orange-100', 'text' => 'text-orange-600', 'icon' => 'cat'],
                'green' => ['border' => 'border-green-500', 'bg' => 'bg-green-100', 'text' => 'text-green-600', 'icon' => 'rabbit'],
                'red' => ['border' => 'border-red-500', 'bg' => 'bg-red-100', 'text' => 'text-red-600', 'icon' => 'dove'],
                'indigo' => ['border' => 'border-indigo-500', 'bg' => 'bg-indigo-100', 'text' => 'text-indigo-600', 'icon' => 'dragon'],
                'pink' => ['border' => 'border-pink-500', 'bg' => 'bg-pink-100', 'text' => 'text-pink-600', 'icon' => 'fish'],
            ];
            $colorIndex = 0;
        @endphp
        
        @foreach($speciesCount as $species => $count)
            @php
                $colorKeys = array_keys($colorClasses);
                $color = $colorKeys[$colorIndex % count($colorKeys)];
                $colorConfig = $colorClasses[$color];
                $colorIndex++;
                
                // Map species to icons
                $iconMap = [
                    'Perro' => 'dog',
                    'Gato' => 'cat',
                    'Conejo' => 'rabbit',
                    'Ave' => 'dove',
                    'Roedor' => 'mouse',
                    'Reptil' => 'dragon',
                    'Pez' => 'fish',
                    'Tortuga' => 'turtle',
                    'Hurón' => 'ferret',
                    'Caballo' => 'horse',
                    'Otro' => 'paw'
                ];
                $icon = $iconMap[$species] ?? 'paw';
            @endphp
            
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 {{ $colorConfig['border'] }}">
                <div class="flex items-center">
                    <div class="p-3 rounded-full {{ $colorConfig['bg'] }} {{ $colorConfig['text'] }} mr-4">
                        <i class="fas fa-{{ $icon }} text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">{{ $species }}</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($mascotas->count() > 0)
        <!-- Grid View for Medium+ Screens -->
        <div class="hidden md:grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            @foreach ($mascotas as $mascota)
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg border border-gray-100">
                <!-- Pet Header -->
                <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-paw mr-2"></i>
                            {{ $mascota->nombre }}
                        </h3>
                        <span class="bg-white bg-opacity-20 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $mascota->especie }}
                        </span>
                    </div>
                </div>
                
                <!-- Pet Info -->
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-700">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-dna text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Raza</p>
                                <p class="font-medium">{{ $mascota->raza ?: 'No especificada' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center text-gray-700">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-birthday-cake text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fecha de Nacimiento</p>
                                <p class="font-medium">
                                    @if($mascota->fecha_nacimiento)
                                        {{ \Carbon\Carbon::parse($mascota->fecha_nacimiento)->format('d/m/Y') }}
                                        <span class="text-xs text-gray-500 ml-1">
                                            ({{ \Carbon\Carbon::parse($mascota->fecha_nacimiento)->age }} años)
                                        </span>
                                    @else
                                        No especificada
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center text-gray-700">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-alt text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Registrada desde</p>
                                <p class="font-medium">{{ $mascota->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-3 mt-6 pt-4 border-t border-gray-100">
                        <a href="{{ route('mascotas.edit', $mascota->id) }}" 
                           class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-amber-500 text-white text-sm font-medium rounded-lg hover:from-yellow-600 hover:to-amber-600 transition-all duration-200 shadow-sm">
                            <i class="fas fa-edit mr-2"></i>
                            Editar
                        </a>
                        <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar a {{ $mascota->nombre }}?')"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-medium rounded-lg hover:from-red-600 hover:to-pink-600 transition-all duration-200 shadow-sm">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Table View for Small Screens -->
        <div class="block md:hidden bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">Mascota</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Especie</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($mascotas as $mascota)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-paw text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $mascota->nombre }}</p>
                                        <p class="text-xs text-gray-500">{{ $mascota->raza ?: 'Sin raza' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $mascota->especie }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <a href="{{ route('mascotas.edit', $mascota->id) }}" 
                                       class="inline-flex items-center p-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors duration-200">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar a {{ $mascota->nombre }}?')"
                                                class="inline-flex items-center p-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-paw text-purple-500 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes mascotas registradas</h3>
                <p class="text-gray-600 mb-6">Comienza agregando tu primera mascota para gestionar su información y servicios.</p>
                <a href="{{ route('mascotas.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Agregar mi primera mascota
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .action-btn {
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
    }
</style>

<script>
    // Añadir efectos de hover a las tarjetas
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.bg-white.rounded-xl.shadow-md');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('card-hover');
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('card-hover');
            });
        });
        
        // Añadir efectos a los botones de acción
        const actionButtons = document.querySelectorAll('a, button');
        actionButtons.forEach(button => {
            if (button.classList.contains('bg-gradient-to-r') || 
                button.classList.contains('bg-yellow-100') || 
                button.classList.contains('bg-red-100')) {
                button.classList.add('action-btn');
            }
        });
    });
</script>
@endsection