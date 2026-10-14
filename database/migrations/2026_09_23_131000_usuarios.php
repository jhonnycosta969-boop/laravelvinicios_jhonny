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
        if (Schema::hasTable('usuarios')) {
            return;
        }

        if (Schema::hasTable('usuario')) {
            Schema::rename('usuario', 'usuarios');

            return;
        }

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->enum('tipo_usuario', [
                'administrador',
                'responsavel',
                'professor',
            ]);
            $table->boolean('ativo')->default(true);
            $table->dateTime('data_cadastro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('usuarios')) {
            Schema::dropIfExists('usuarios');
        }
    }
};
