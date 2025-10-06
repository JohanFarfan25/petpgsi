<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;

class MascotaController extends Controller
{
    // ================= API =================
    public function index()
    {
        return response()->json(Mascota::where('user_id', Auth::id())->get());
    }
    public function show($id)
    {
        $m = Mascota::where('id', $id)->where('user_id', Auth::id())->first();
        return $m ? response()->json($m) : response()->json(['message' => 'Mascota no encontrada'], 404);
    }
    public function store(Request $r)
    {
        $r->validate(['nombre' => 'required', 'especie' => 'required', 'raza' => 'nullable', 'fecha_nacimiento' => 'nullable|date']);
        $m = Mascota::create(['user_id' => Auth::id(), 'nombre' => $r->nombre, 'especie' => $r->especie, 'raza' => $r->raza, 'fecha_nacimiento' => $r->fecha_nacimiento]);
        return response()->json($m, 201);
    }
    public function update(Request $r, $id)
    {
        $m = Mascota::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$m) return response()->json(['message' => 'Mascota no encontrada'], 404);
        $m->update($r->only(['nombre', 'especie', 'raza', 'fecha_nacimiento']));
        return response()->json($m);
    }
    public function destroy($id)
    {
        $m = Mascota::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$m) return response()->json(['message' => 'Mascota no encontrada'], 404);
        $m->delete();
        return response()->json(['message' => 'Mascota eliminada']);
    }

    // ================= WEB =================
    public function indexWeb()
    {
        $mascotas = Mascota::where('user_id', Auth::id())->get();
        return view('mascotas.index', compact('mascotas'));
    }
    public function create()
    {
        return view('mascotas.create');
    }
    public function storeWeb(Request $r)
    {
        $r->validate(['nombre' => 'required', 'especie' => 'required', 'raza' => 'nullable', 'fecha_nacimiento' => 'nullable|date']);
        Mascota::create(['user_id' => Auth::id(), 'nombre' => $r->nombre, 'especie' => $r->especie, 'raza' => $r->raza, 'fecha_nacimiento' => $r->fecha_nacimiento]);
        return redirect()->route('mascotas.index')->with('success', 'Mascota creada correctamente');
    }
    public function edit($id)
    {
        $m = Mascota::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('mascotas.edit', ['mascota' => $m]);
    }
    public function updateWeb(Request $r, $id)
    {
        $m = Mascota::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $r->validate(['nombre' => 'required', 'especie' => 'required', 'raza' => 'nullable', 'fecha_nacimiento' => 'nullable|date']);
        $m->update($r->only(['nombre', 'especie', 'raza', 'fecha_nacimiento']));
        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada correctamente');
    }
    public function destroyWeb($id)
    {
        $m = Mascota::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $m->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada correctamente');
    }
}
