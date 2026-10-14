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
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_material')->constrained('materiais');
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim')->nullable();
            $table->text('problema');
            $table->text('solucao')->nullable();
            $table->enum('status', [
                'aberta',
                'em_andamento',
                'concluida',
                'cancelada',
            ])->default('aberta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencoes');
    }
};
