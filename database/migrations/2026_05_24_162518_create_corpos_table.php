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
        Schema::create('corpos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('tipo', ['planeta', 'lua', 'estrela', 'asteroide', 'cometa', 'nebulosa']);
            $table->string('distancia_terra');
            $table->float('diametro_km')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corpos');
    }
};
