@extends('layouts.app')
@section('title', 'Editar Cita')

@section('content')
<div class="max-w-md mx-auto py-8 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Editar Cita</h1>
        <p class="text-gray-600 text-sm">Actualiza los datos de la cita programada</p>
    </div>

    <!-- Form -->
    <form action="{{ route('citas.update', $cita->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <!-- Mascota -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mascota</label>
                <select name="mascota_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selecciona una mascota</option>
                    @foreach($mascotas as $mascota)
                        <option value="{{ $mascota->id }}" {{ $cita->mascota_id == $mascota->id ? 'selected' : '' }}>
                            {{ $mascota->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Servicio -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                <select name="servicio_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selecciona un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}" {{ $cita->servicio_id == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha y Hora -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha y Hora</label>
                <input type="datetime-local" 
                       name="fecha" 
                       value="{{ \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d\TH:i') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>

            <!-- Nota -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nota (opcional)</label>
                <textarea name="nota" 
                          placeholder="Agrega alguna nota o comentario..."
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">{{ $cita->nota }}</textarea>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex gap-3 pt-4">
            <button type="submit" 
                    class="flex-1 bg-blue-600 text-white py-2 px-4 rounded font-medium hover:bg-blue-700 transition-colors">
                Actualizar Cita
            </button>
            
            <a href="{{ route('citas.index') }}" 
               class="bg-gray-200 text-gray-800 py-2 px-4 rounded font-medium hover:bg-gray-300 transition-colors">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer fecha mínima como hoy para evitar fechas pasadas
        const fechaInput = document.querySelector('input[type="datetime-local"]');
        if (fechaInput) {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            
            const minDateTime = `${year}-${month}-${day}T00:00`;
            fechaInput.min = minDateTime;
        }
    });
</script>
@endsection