<?php
namespace App\Services;
use App\Models\Mascota;

class MascotaService {
    public function getById(int $id): ?Mascota {
        return Mascota::find($id);
    }
}
