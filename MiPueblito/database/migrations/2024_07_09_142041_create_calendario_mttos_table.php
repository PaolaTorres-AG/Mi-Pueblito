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
        Schema::create('calendario_mttos', function (Blueprint $table) {
            $table->id();
             $table->string('event_id')->nullable(); 
            $table->string('title')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('recurrence')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('lugar')->nullable();
            $table->string('description')->nullable();
            $table->string('departamento')->nullable();
            $table->string('estatus')->nullable();
            $table->string('correo')->nullable();
            $table->string('dispositivo')->nullable();
            $table->string('dispositivo_id')->nullable();
            $table->string('background')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_mttos');
    }
};
