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
        Schema::create('missoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data_lancamento');
            $table->date('data_retorno')->nullable()->constantrained('corpos_celestes')->nullOnDelete();
            $table->enum('status', ['planejada', 'em andamento', 'concluida', 'cancelada'])->default('planejada');
            $table->text('descricao')->nullable();
            $table->foreignId('corpo_celeste_id');
            $table->timestamps();
        });

        
        Schema::create('astronauta_missao', function(Blueprint $table) {
        $table->id();
        $table->foreignId('astronauta_id')->constrained('astronautas')->cascadeOnDeLenete();
        $table->foreignId('missao_id')->constrained('missoes')->cascadeOnDeLenete();
    });
    }

    

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missoes');
        Schema::dropIfExists('astronauta_missao');
    }
};
