<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;

class MascotaController extends Controller
{
    /**
     * Listar todas las mascotas del usuario autenticado
     */
    public function index()
    {
        $user = Auth::user();

        $mascotas = Mascota::where('user_id', $user->id)->get();

        return response()->json($mascotas);
    }

    /**
     * Mostrar una mascota específica
     */
    public function show($id)
    {
        $mascota = Mascota::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$mascota) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        return response()->json($mascota);
    }

    /**
     * Crear una nueva mascota
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date'
        ]);

        $mascota = Mascota::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'fecha_nacimiento' => $request->fecha_nacimiento
        ]);

        return response()->json($mascota, 201);
    }

    /**
     * Actualizar una mascota existente
     */
    public function update(Request $request, $id)
    {
        $mascota = Mascota::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$mascota) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        $mascota->update($request->only(['nombre', 'especie', 'raza', 'fecha_nacimiento']));

        return response()->json($mascota);
    }

    /**
     * Eliminar una mascota
     */
    public function destroy($id)
    {
        $mascota = Mascota::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$mascota) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        $mascota->delete();

        return response()->json(['message' => 'Mascota eliminada correctamente']);
    }
}
