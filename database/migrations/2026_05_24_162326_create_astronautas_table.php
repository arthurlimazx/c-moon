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
        Schema::create('astronautas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nacionalidade');
            $table->string('especialidade');
            $table->integer('num_missoes')->default(0);
            $table->enum('status', ['ativo', 'inativo', 'aposentado'])->default('ativo');
            $table->string('fotos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astronautas');
    }
};
