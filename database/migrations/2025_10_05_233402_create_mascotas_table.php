<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->string('especie')->nullable();
            $table->string('raza')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
