<?php

namespace App\Services;

use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;

class MascotaService 
{
    public function getById(int $id): ?Mascota 
    {
        return Mascota::find($id);
    }

    public function listByUser(int $userId)
    {
        return Mascota::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return Mascota::create($data);
    }

    public function update(int $id, array $data)
    {
        $mascota = Mascota::find($id);
        if ($mascota) {
            $mascota->update($data);
        }
        return $mascota;
    }

    public function delete(int $id)
    {
        $mascota = Mascota::find($id);
        if ($mascota) {
            $mascota->delete();
            return true;
        }
        return false;
    }
}