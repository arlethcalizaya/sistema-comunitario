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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('zona_id')->nullable()->constrained('zonas');
            $table->string('titulo');
            $table->text('descripcion');
            $table->decimal('latitud', 10, 8);
            $table->decimal('longitud', 11, 8);
            $table->string('direccion')->nullable();
            $table->enum('prioridad', ['baja', 'media', 'alta', 'critica'])->default('baja');
            $table->enum('estado', ['pendiente', 'revision', 'proceso', 'resuelto', 'rechazado'])->default('pendiente');
            $table->timestamps();
        });

    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
