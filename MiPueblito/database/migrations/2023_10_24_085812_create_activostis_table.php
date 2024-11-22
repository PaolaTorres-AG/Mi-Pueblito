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
        Schema::create('activostis', function (Blueprint $table) {
            $table->id();
            $table->string('tipos_dispositivo')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('wifi_ethernet')->nullable();
            $table->string('mac')->nullable();
            $table->string('ip')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('fecha_compra')->nullable();
            $table->string('activo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activostis');
    }
};
