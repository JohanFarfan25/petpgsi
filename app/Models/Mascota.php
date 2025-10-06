<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model {
    protected $fillable = ['user_id','nombre','especie','raza','fecha_nacimiento'];
    public function owner(){ return $this->belongsTo(User::class, 'user_id'); }
    public function citas(){ return $this->hasMany(Cita::class); }
}
