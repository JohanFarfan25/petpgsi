<?php
namespace App\Services;
use App\Models\Cita;
use Carbon\Carbon;

class ValidationService {
    /**
     * Comprueba si la fecha/hora está disponible para el servicio.
     * Simple: evita solapamientos exactos. Puedes mejorar por rango (duracion de servicio).
     */
    public function isAvailable(string $fecha, int $servicioId): bool {
        $dt = Carbon::parse($fecha);
        // Control simple: no otra cita exactamente en la misma fecha para el mismo servicio
        $exists = Cita::where('servicio_id', $servicioId)
                      ->where('fecha', $dt->toDateTimeString())
                      ->where('estado','programada')
                      ->exists();
        return !$exists;
    }
}
