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
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('departamento');
            $table->string('data_admissao');
            $table->unsignedBigInteger('autor_id');
            $table->foreign('autor_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionario', function (Blueprint $table) {
            $table->dropForeign('[usuario_id]');
            $table->dropColumn('usuario_id');
    
            });
            Schema::dropIfExists('funcionario');
        }
};
