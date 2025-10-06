<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    // 🩺 Obtener todos los servicios
    public function index()
    {
        return response()->json(Servicio::all());
    }

    // 🩺 Obtener un servicio específico
    public function show($id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }
        return response()->json($servicio);
    }

    // 🩺 Crear un nuevo servicio (solo admin o pruebas)
    public function store(Request $r)
    {
        $data = $r->validate([
            'nombre' => 'required|string',
            'duracion_minutos' => 'required|integer|min:5',
            'precio' => 'required|numeric|min:0',
        ]);

        $servicio = Servicio::create($data);
        return response()->json($servicio, 201);
    }

    // 🩺 Actualizar servicio
    public function update(Request $r, $id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        $servicio->update($r->only(['nombre', 'duracion_minutos', 'precio']));
        return response()->json($servicio);
    }

    // 🩺 Eliminar servicio
    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        if (!$servicio) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        $servicio->delete();
        return response()->json(['message' => 'Servicio eliminado']);
    }
}
