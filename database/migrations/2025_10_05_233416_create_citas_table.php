<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // dueño / creador
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->enum('estado', ['programada', 'cancelada', 'finalizada'])->default('programada');
            $table->text('nota')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
