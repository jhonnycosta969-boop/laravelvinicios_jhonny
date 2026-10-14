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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nome')->index();
            $table->text('descricao')->nullable();
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_localizacao')->constrained('localizacoes');
            $table->unsignedInteger('quantidade')->default(0);
            $table->unsignedInteger('quantidade_disponivel')->default(0);
            $table->unsignedInteger('quantidade_minima')->default(0);
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->enum('status', [
                'disponivel',
                'emprestado',
                'manutencao',
                'defeito',
                'indisponivel',
            ])->default('disponivel');
            $table->text('observacoes')->nullable();
            $table->timestamp('data_cadastro')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais');
    }
};
