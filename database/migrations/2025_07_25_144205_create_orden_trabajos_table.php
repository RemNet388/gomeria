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
    Schema::create('orden_trabajos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');
        $table->text('detalle')->nullable();
        $table->string('estado')->default('Pendiente'); // Ej: Pendiente, En reparación, Finalizado
        $table->date('fecha_entrada')->nullable();
        $table->date('fecha_salida')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_trabajos');
    }
};
