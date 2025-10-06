<?php
namespace App\Services;
use App\Models\Cita;
use Carbon\Carbon;

class ValidationService {

    public function isAvailable(string $fecha, int $servicioId): bool {
        $dt = Carbon::parse($fecha);
        $exists = Cita::where('servicio_id', $servicioId)
                      ->where('fecha', $dt->toDateTimeString())
                      ->where('estado','programada')
                      ->exists();
        return !$exists;
    }
}
