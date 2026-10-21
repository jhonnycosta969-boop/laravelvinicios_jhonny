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
        Schema::table('usuarios', function (Blueprint $table) {
            if (! Schema::hasColumn('usuarios', 'tipo_usuario')) {
                $table->enum('tipo_usuario', [
                    'administrador',
                    'responsavel',
                    'professor',
                ])->default('professor');
            }

            if (! Schema::hasColumn('usuarios', 'ativo')) {
                $table->boolean('ativo')->default(true);
            }

            if (! Schema::hasColumn('usuarios', 'data_cadastro')) {
                $table->dateTime('data_cadastro')->useCurrent();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $columns = collect(['tipo_usuario', 'ativo', 'data_cadastro'])
                ->filter(fn (string $column): bool => Schema::hasColumn('usuarios', $column))
                ->all();

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
