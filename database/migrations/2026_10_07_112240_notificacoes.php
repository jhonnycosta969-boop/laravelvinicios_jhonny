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
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->string('titulo');
            $table->text('mensagem');
            $table->enum('tipo', [
                'estoque_baixo',
                'devolucao_atrasada',
                'pedido',
                'emprestimo',
                'manutencao',
                'sistema',
            ]);
            $table->boolean('lida')->default(false);
            $table->dateTime('data_criacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacoes');
    }
};
