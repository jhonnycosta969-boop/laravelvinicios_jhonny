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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->dateTime('data_pedido');
            $table->string('finalidade');
            $table->enum('status', [
                'solicitado',
                'aprovado',
                'separando',
                'entregue',
                'recusado',
                'cancelado',
            ])->default('solicitado')->index();
            $table->text('observacao')->nullable();
            $table->foreignId('aprovado_por')->nullable()->constrained('usuarios');
            $table->dateTime('data_aprovacao')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
