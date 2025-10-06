@extends('layouts.app')
@section('title', isset($cita) ? 'Editar Cita' : 'Agendar Cita')

@section('content')
<div class="max-w-md mx-auto py-8 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">
            {{ isset($cita) ? 'Editar Cita' : 'Agendar Cita' }}
        </h1>
        <p class="text-gray-600 text-sm">
            {{ isset($cita) ? 'Modifica los datos de la cita' : 'Completa los datos para agendar una cita' }}
        </p>
    </div>

    <!-- Form -->
    <form action="{{ isset($cita) ? route('citas.update', $cita->id) : route('citas.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($cita)) @method('PUT') @endif

        <div class="space-y-4">
            <!-- Mascota -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mascota</label>
                <select name="mascota_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Selecciona una mascota</option>
                    @foreach($mascotas as $mascota)
                        <option value="{{ $mascota->id }}" 
                            @if(isset($cita) && $cita->mascota_id == $mascota->id) selected 
                            @elseif(old('mascota_id') == $mascota->id) selected @endif>
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
                        <option value="{{ $servicio->id }}" 
                            @if(isset($cita) && $cita->servicio_id == $servicio->id) selected 
                            @elseif(old('servicio_id') == $servicio->id) selected @endif>
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
                       value="{{ isset($cita) ? \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d\TH:i') : old('fecha') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>

            <!-- Nota -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nota (opcional)</label>
                <textarea name="nota" 
                          placeholder="Agrega alguna nota o comentario..."
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500">{{ $cita->nota ?? old('nota') }}</textarea>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex gap-3 pt-4">
            <button type="submit" 
                    class="flex-1 bg-blue-600 text-white py-2 px-4 rounded font-medium hover:bg-blue-700 transition-colors">
                {{ isset($cita) ? 'Actualizar Cita' : 'Agendar Cita' }}
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
        // Establecer fecha mínima como hoy
        const fechaInput = document.querySelector('input[type="datetime-local"]');
        if (fechaInput) {
            const now = new Date();
            // Redondear a los próximos 15 minutos
            const minutes = Math.ceil(now.getMinutes() / 15) * 15;
            now.setMinutes(minutes);
            now.setSeconds(0);
            
            // Formatear a YYYY-MM-DDTHH:MM
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutesFormatted = String(now.getMinutes()).padStart(2, '0');
            
            const minDateTime = `${year}-${month}-${day}T${hours}:${minutesFormatted}`;
            fechaInput.min = minDateTime;
            
            // Si no hay valor establecido, poner el valor mínimo
            if (!fechaInput.value) {
                fechaInput.value = minDateTime;
            }
        }
    });
</script>
@endsection