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
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('t_dispositivo')->nullable();
            $table->string('estado_disp')->nullable();
            $table->string('marca_disp')->nullable();
            $table->string('modelo_disp')->nullable();
            $table->string('numserie_disp')->nullable();
            $table->string('mac_disp')->nullable();
            $table->string('imei_disp')->nullable();
            $table->string('fecha_compra')->nullable();
            $table->string('fecha_asignacion')->nullable();
            $table->string('ip_disp')->nullable();
            $table->string('observaciones_disp')->nullable();
            $table->string('estatus_disp')->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};