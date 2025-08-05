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
        Schema::create('orden_trabajo_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('orden_trabajo_id')->constrained()->onDelete('cascade');
    $table->enum('tipo', ['producto', 'servicio']);
    $table->unsignedBigInteger('producto_id')->nullable();
    $table->unsignedBigInteger('servicio_id')->nullable();
    $table->integer('cantidad')->default(1);
    $table->decimal('precio', 10, 2)->default(0);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_trabajo_items');
    }
};
