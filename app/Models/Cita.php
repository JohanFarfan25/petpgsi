<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model {
    protected $fillable = ['user_id','mascota_id','servicio_id','fecha','estado','nota'];
    public function mascota(){ return $this->belongsTo(Mascota::class); }
    public function servicio(){ return $this->belongsTo(Servicio::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
