<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ValidationService;
use App\Services\MascotaService;
use App\Services\AgendaService;
use App\Services\NotificationService;

class AgendaFacadeController extends Controller {
    protected $validation, $mascota, $agenda, $notification;

    public function __construct(
        ValidationService $validation,
        MascotaService $mascota,
        AgendaService $agenda,
        NotificationService $notification
    ){
        $this->validation = $validation;
        $this->mascota = $mascota;
        $this->agenda = $agenda;
        $this->notification = $notification;
    }

    // POST /api/citas
    public function store(Request $r){
        $data = $r->validate([
            'mascota_id'=>'required|int',
            'servicio_id'=>'required|int',
            'fecha'=>'required|date',
            'nota'=>'nullable|string'
        ]);

        // 1) Validación de disponibilidad
        if(!$this->validation->isAvailable($data['fecha'], $data['servicio_id'])){
            return response()->json(['error'=>'Fecha/Hora no disponible'], 409);
        }

        // 2) Validar mascota
        $mascota = $this->mascota->getById($data['mascota_id']);
        if(!$mascota) return response()->json(['error'=>'Mascota no encontrada'], 404);

        // 3) Crear cita (agenda service)
        $payload = [
            'user_id' => auth()->id(),
            'mascota_id' => $data['mascota_id'],
            'servicio_id' => $data['servicio_id'],
            'fecha' => $data['fecha'],
            'nota' => $data['nota'] ?? null
        ];

        $cita = $this->agenda->create($payload);

        // 4) Notificar
        $this->notification->notify(auth()->id(), "Cita creada para {$data['fecha']}");

        return response()->json(['cita' => $cita], 201);
    }

    // GET /api/citas
    public function index(){
        $list = $this->agenda->listByUser(auth()->id());
        return response()->json($list);
    }

    // PUT /api/citas/{id}
    public function update(Request $r, $id){
        $data = $r->only(['fecha','nota','estado','servicio_id']);
        if(isset($data['fecha']) && !$this->validation->isAvailable($data['fecha'], $data['servicio_id'] ?? null)){
            return response()->json(['error'=>'Fecha/Hora no disponible'], 409);
        }
        $cita = $this->agenda->update($id, $data);
        return response()->json($cita);
    }

    // DELETE /api/citas/{id}
    public function destroy($id){
        $this->agenda->delete($id);
        return response()->json(['message'=>'Cita cancelada']);
    }
}
