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
    $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
    $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');
    $table->date('fecha_ingreso')->default(now());
    $table->string('estado')->default('Pendiente'); // Pendiente, En proceso, Finalizado
    $table->text('descripcion')->nullable();
    $table->text('observaciones')->nullable();
    $table->decimal('total', 10, 2)->nullable();
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
