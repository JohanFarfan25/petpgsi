@extends('layouts.app')
@section('title', 'Mis Citas')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl font-bold text-gray-900">Mis Citas</h1>
            <p class="text-gray-600 text-sm mt-1">Gestiona tus citas programadas</p>
        </div>
        <a href="{{ route('citas.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded font-medium hover:bg-blue-700 transition-colors">
            Agendar Nueva Cita
        </a>
    </div>

    @if($citas->count() > 0)
        <!-- Citas List -->
        <div class="space-y-4">
            @foreach($citas as $cita)
            <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <!-- Información principal -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-2">
                            <h3 class="font-semibold text-gray-900">{{ $cita->mascota->nombre ?? 'N/A' }}</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                {{ $cita->servicio->nombre ?? 'N/A' }}
                            </span>
                        </div>
                        
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <span>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y H:i') }}</span>
                            <span>{{ $cita->nota ?: 'Sin nota' }}</span>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex gap-2 mt-3 lg:mt-0">
                        <a href="{{ route('citas.edit', $cita->id) }}" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition-colors">
                            Editar
                        </a>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition-colors"
                                    onclick="return confirm('¿Estás seguro de que quieres cancelar esta cita?')">
                                Cancelar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white border border-gray-200 rounded-lg p-8 text-center">
            <p class="text-gray-500 mb-4">No tienes citas agendadas.</p>
            <a href="{{ route('citas.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded font-medium hover:bg-blue-700 transition-colors">
                Agendar tu primera cita
            </a>
        </div>
    @endif
</div>
@endsection