<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagenes_reportes', function (Blueprint $table) {
            $table->id();
            // Relacionamos con la tabla reportes
            $table->foreignId('reporte_id')->constrained('reportes')->onDelete('cascade');
            $table->string('ruta'); // Aquí se guarda el camino a la foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes_reportes');
    }
};