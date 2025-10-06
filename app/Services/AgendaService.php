<?php
namespace App\Services;
use App\Models\Cita;
use Illuminate\Support\Facades\DB;
use Exception;

class AgendaService {
    public function create(array $data): Cita {
        // $data debe contener: user_id, mascota_id, servicio_id, fecha, nota(optional)
        return DB::transaction(function() use ($data) {
            return Cita::create($data);
        });
    }

    public function update(int $id, array $data): ?Cita {
        $cita = Cita::findOrFail($id);
        $cita->update($data);
        return $cita;
    }

    public function delete(int $id): bool {
        $cita = Cita::findOrFail($id);
        return (bool) $cita->delete();
    }

    public function listByUser(int $userId){
        return Cita::with(['mascota','servicio'])->where('user_id',$userId)->get();
    }
}
