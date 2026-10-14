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
        if (Schema::hasTable('funcionarios')) {
            return;
        }

        if (Schema::hasTable('funcionario')) {
            Schema::rename('funcionario', 'funcionarios');

            return;
        }

        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('departamento');
            $table->string('data_admissao');
            $table->foreignId('autor_id')->constrained('usuarios')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('funcionarios')) {
            Schema::dropIfExists('funcionarios');
        }
    }
};
