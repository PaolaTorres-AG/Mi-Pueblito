<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('dto');
            $table->string('t_incidencia');
            $table->string('descripcion');
            $table->string('prioridad');
            $table->string('estatus');
            $table->string('asignado');
            $table->string('clasificacion');
            $table->string('observaciones');
            $table->string('fecha_inicial');
            $table->string('fecha_final');
            $table->string('email');
            $table->string('imagen');
            $table->string('user_id');
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soportes');
    }
};
