<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('duracion_minutos')->default(30);
            $table->decimal('precio', 10, 2)->default(0);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
