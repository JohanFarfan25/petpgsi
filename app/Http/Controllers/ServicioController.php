<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    // ================= API =================
    public function index()
    {
        return response()->json(Servicio::all());
    }
    public function show($id)
    {
        $s = Servicio::find($id);
        return $s ? response()->json($s) : response()->json(['error' => 'Servicio no encontrado'], 404);
    }
    public function store(Request $r)
    {
        $d = $r->validate(['nombre' => 'required', 'duracion_minutos' => 'required|int', 'precio' => 'required|numeric']);
        $s = Servicio::create($d);
        return response()->json($s, 201);
    }
    public function update(Request $r, $id)
    {
        $s = Servicio::find($id);
        if (!$s) return response()->json(['error' => 'Servicio no encontrado'], 404);
        $s->update($r->only(['nombre', 'duracion_minutos', 'precio']));
        return response()->json($s);
    }
    public function destroy($id)
    {
        $s = Servicio::find($id);
        if (!$s) return response()->json(['error' => 'Servicio no encontrado'], 404);
        $s->delete();
        return response()->json(['message' => 'Servicio eliminado']);
    }

    // ================= WEB =================
    public function indexWeb()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }
    public function create()
    {
        return view('servicios.create');
    }
    public function storeWeb(Request $r)
    {
        $d = $r->validate(['nombre' => 'required', 'duracion_minutos' => 'required|int', 'precio' => 'required|numeric']);
        Servicio::create($d);
        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente');
    }
    public function edit($id)
    {
        $s = Servicio::findOrFail($id);
        return view('servicios.edit', ['servicio' => $s]);
    }
    public function updateWeb(Request $r, $id)
    {
        $s = Servicio::findOrFail($id);
        $d = $r->validate(['nombre' => 'required', 'duracion_minutos' => 'required|int', 'precio' => 'required|numeric']);
        $s->update($d);
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');
    }
    public function destroyWeb($id)
    {
        $s = Servicio::findOrFail($id);
        $s->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente');
    }
}
