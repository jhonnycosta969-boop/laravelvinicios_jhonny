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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_material')->constrained('materiais');
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->enum('tipo', [
                'entrada',
                'saida',
                'retirada',
                'devolucao',
                'perda',
                'dano',
                'ajuste',
                'manutencao',
            ]);
            $table->unsignedInteger('quantidade');
            $table->dateTime('data_hora')->index();
            $table->text('observacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};
