<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Services\MascotaService;
use App\Services\AgendaService;
use App\Services\NotificationService;
use App\Models\Servicio;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class AgendaFacadeController extends Controller
{
    protected $validation, $mascota, $agenda, $notification;

    public function __construct(ValidationService $validation, MascotaService $mascota, AgendaService $agenda, NotificationService $notification)
    {
        $this->validation = $validation;
        $this->mascota = $mascota;
        $this->agenda = $agenda;
        $this->notification = $notification;
    }

    // ================= API =================
    public function index()
    {
        return response()->json($this->agenda->listByUser(Auth::id()));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'mascota_id' => 'required|int',
            'servicio_id' => 'required|int',
            'fecha' => 'required|date',
            'nota' => 'nullable|string'
        ]);

        if (!$this->validation->isAvailable($data['fecha'], $data['servicio_id'])) {
            return response()->json(['error' => 'Fecha/Hora no disponible'], 409);
        }

        $m = $this->mascota->getById($data['mascota_id']);
        if (!$m) {
            return response()->json(['error' => 'Mascota no encontrada'], 404);
        }

        $c = $this->agenda->create([
            'user_id' => Auth::id(),
            'mascota_id' => $data['mascota_id'],
            'servicio_id' => $data['servicio_id'],
            'fecha' => $data['fecha'],
            'nota' => $data['nota'] ?? null
        ]);

        $this->notification->notify(Auth::id(), "Cita creada para {$data['fecha']}");
        return response()->json(['cita' => $c], 201);
    }

    public function update(Request $r, $id)
    {
        $d = $r->only(['fecha', 'nota', 'estado', 'servicio_id']);

        if (isset($d['fecha']) && !$this->validation->isAvailable($d['fecha'], $d['servicio_id'] ?? null)) {
            return response()->json(['error' => 'Fecha/Hora no disponible'], 409);
        }

        $c = $this->agenda->update($id, $d);
        return response()->json($c);
    }

    public function destroy($id)
    {
        $this->agenda->delete($id);
        return response()->json(['message' => 'Cita cancelada']);
    }

    // ================= WEB =================
    public function indexWeb()
    {
        $list = $this->agenda->listByUser(Auth::id());
        return view('citas.index', ['citas' => $list]);
    }

    public function createWeb()
    {
        $mascotas = $this->mascota->listByUser(Auth::id());
        $servicios = Servicio::all();
        return view('citas.create', compact('mascotas', 'servicios'));
    }

    public function editWeb($id)
    {
        // Obtener la cita específica
        $cita = $this->agenda->getById($id);

        // Verificar que la cita exista y pertenezca al usuario
        if (!$cita || $cita->user_id != Auth::id()) {
            abort(404, 'Cita no encontrada');
        }

        $mascotas = $this->mascota->listByUser(Auth::id());
        $servicios = Servicio::all();

        return view('citas.edit', compact('cita', 'mascotas', 'servicios'));
    }

    public function storeWeb(Request $r)
    {
        $data = $r->validate([
            'mascota_id' => 'required|int',
            'servicio_id' => 'required|int',
            'fecha' => 'required|date',
            'nota' => 'nullable|string'
        ]);

        if (!$this->validation->isAvailable($data['fecha'], $data['servicio_id'])) {
            return back()->withErrors(['fecha' => 'Fecha/Hora no disponible']);
        }

        $this->agenda->create([
            'user_id' => Auth::id(),
            'mascota_id' => $data['mascota_id'],
            'servicio_id' => $data['servicio_id'],
            'fecha' => $data['fecha'],
            'nota' => $data['nota'] ?? null
        ]);

        $this->notification->notify(Auth::id(), "Cita creada para {$data['fecha']}");
        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente');
    }

    public function updateWeb(Request $r, $id)
    {
        $d = $r->only(['fecha', 'nota', 'estado', 'servicio_id']);

        if (isset($d['fecha']) && !$this->validation->isAvailable($d['fecha'], $d['servicio_id'] ?? null)) {
            return back()->withErrors(['fecha' => 'Fecha/Hora no disponible']);
        }

        $this->agenda->update($id, $d);
        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroyWeb($id)
    {
        $this->agenda->delete($id);
        return redirect()->route('citas.index')->with('success', 'Cita cancelada correctamente');
    }
}
