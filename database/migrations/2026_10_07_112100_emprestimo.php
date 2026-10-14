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
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->dateTime('data_retirada');
            $table->dateTime('data_devolucao')->nullable();
            $table->dateTime('previsao_devolucao');
            $table->enum('status', [
                'solicitado',
                'aprovado',
                'emprestado',
                'devolvido',
                'atrasado',
                'cancelado',
            ])->default('solicitado')->index();
            $table->text('observacao')->nullable();
            $table->timestamp('criado_em')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};
