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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colaborador_id');
            $table->foreign('colaborador_id')->references('id')->on('users');
            $table->string('tipo_disp')->nullable();
            $table->string('estado_disp')->nullable();
            $table->string('nombre_disp')->nullable();
            $table->string('mac')->nullable();
            $table->string('ip_dhcp')->nullable();
       
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('num_serie')->nullable();
            $table->string('proc_velocidad')->nullable();
            $table->string('memoria')->nullable();
            $table->string('disco')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('so')->nullable();
            $table->string('ip')->nullable();
            $table->string('correo_disp')->nullable();
            $table->string('programas_instalados')->nullable();
            $table->string('v_office')->nullable();
            $table->string('clave_office')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('activo')->nullable(); 
            $table->string('wifi_ethernet')->nullable();
            $table->string('obs_equipo')->nullable();
            $table->string('identificar')->nullable();
            $table->string('fecha_compra')->nullable();
            $table->string('fecha_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
