<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmprestimoControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->string('email')->unique();
                $table->string('senha');
                $table->string('tipo_usuario')->default('professor');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('categorias')) {
            Schema::create('categorias', function (Blueprint $table) {
                $table->id();
                $table->string('codigo')->unique()->nullable();
                $table->string('nome');
                $table->text('descricao')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('localizacoes')) {
            Schema::create('localizacoes', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->text('descricao')->nullable();
                $table->string('codigo')->unique();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('materiais')) {
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
                $table->enum('status', ['disponivel', 'emprestado', 'manutencao', 'defeito', 'indisponivel'])->default('disponivel');
                $table->text('observacoes')->nullable();
                $table->timestamp('data_cadastro')->useCurrent();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('emprestimos')) {
            Schema::create('emprestimos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_usuario')->constrained('usuarios');
                $table->dateTime('data_retirada');
                $table->dateTime('data_devolucao')->nullable();
                $table->dateTime('previsao_devolucao');
                $table->enum('status', ['solicitado', 'aprovado', 'emprestado', 'devolvido', 'atrasado', 'cancelado'])->default('solicitado');
                $table->text('observacao')->nullable();
                $table->timestamp('criado_em')->useCurrent();
            });
        }

        if (! Schema::hasTable('itens_emprestimo')) {
            Schema::create('itens_emprestimo', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_emprestimo')->constrained('emprestimos');
                $table->foreignId('id_material')->constrained('materiais');
                $table->unsignedInteger('quantidade');
                $table->unsignedInteger('quantidade_devolvida')->default(0);
            });
        }
    }

    public function test_can_create_usuario_with_usuarios_table(): void
    {
        $response = $this->postJson('/api/cadastro_usuario', [
            'nome' => 'Maria Silva',
            'email' => 'maria@teste.com',
            'senha' => '12345678',
            'senha_confirmation' => '12345678',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('usuario.nome', 'Maria Silva');

        $this->assertDatabaseHas('usuarios', [
            'email' => 'maria@teste.com',
        ]);
    }

    public function test_can_create_emprestimo_with_material_item(): void
    {
        $usuarioId = DB::table('usuarios')->insertGetId([
            'nome' => 'Maria Silva',
            'email' => 'maria2@teste.com',
            'senha' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categoriaId = DB::table('categorias')->insertGetId([
            'codigo' => 'CAT-1',
            'nome' => 'Eletrônicos',
            'descricao' => 'Categoria de teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $localizacaoId = DB::table('localizacoes')->insertGetId([
            'codigo' => 'LOC-1',
            'nome' => 'Almoxarifado',
            'descricao' => 'Local de teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $materialId = DB::table('materiais')->insertGetId([
            'codigo' => 'MAT-001',
            'nome' => 'Notebook',
            'descricao' => 'Material de teste',
            'id_categoria' => $categoriaId,
            'id_localizacao' => $localizacaoId,
            'quantidade' => 10,
            'quantidade_disponivel' => 10,
            'quantidade_minima' => 1,
            'marca' => 'Dell',
            'modelo' => 'Inspiron',
            'status' => 'disponivel',
            'observacoes' => 'Material de teste',
            'data_cadastro' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->postJson('/api/cadastro_emprestimo', [
            'id_usuario' => $usuarioId,
            'id_material' => $materialId,
            'quantidade' => 2,
            'data_retirada' => now()->toDateTimeString(),
            'previsao_devolucao' => now()->addDays(7)->toDateTimeString(),
            'status' => 'solicitado',
            'observacao' => 'Empréstimo de teste',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('emprestimo.id_usuario', $usuarioId)
            ->assertJsonPath('emprestimo.status', 'solicitado');

        $this->assertDatabaseHas('emprestimos', [
            'id_usuario' => $usuarioId,
            'status' => 'solicitado',
        ]);

        $this->assertDatabaseHas('itens_emprestimo', [
            'id_material' => $materialId,
            'quantidade' => 2,
        ]);
    }

    public function test_can_register_loan_return(): void
    {
        $usuarioId = DB::table('usuarios')->insertGetId([
            'nome' => 'Maria Silva',
            'email' => 'maria3@teste.com',
            'senha' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categoriaId = DB::table('categorias')->insertGetId([
            'codigo' => 'CAT-2',
            'nome' => 'Periféricos',
            'descricao' => 'Categoria de teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $localizacaoId = DB::table('localizacoes')->insertGetId([
            'codigo' => 'LOC-2',
            'nome' => 'Estoque',
            'descricao' => 'Local de teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $materialId = DB::table('materiais')->insertGetId([
            'codigo' => 'MAT-002',
            'nome' => 'Teclado',
            'descricao' => 'Material de teste',
            'id_categoria' => $categoriaId,
            'id_localizacao' => $localizacaoId,
            'quantidade' => 5,
            'quantidade_disponivel' => 5,
            'quantidade_minima' => 1,
            'marca' => 'Logitech',
            'modelo' => 'K120',
            'status' => 'disponivel',
            'observacoes' => 'Material de teste',
            'data_cadastro' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $emprestimoId = DB::table('emprestimos')->insertGetId([
            'id_usuario' => $usuarioId,
            'data_retirada' => now()->subDays(2)->toDateTimeString(),
            'previsao_devolucao' => now()->addDays(2)->toDateTimeString(),
            'status' => 'emprestado',
            'observacao' => 'Empréstimo pendente',
            'criado_em' => now(),
        ]);

        DB::table('itens_emprestimo')->insert([
            'id_emprestimo' => $emprestimoId,
            'id_material' => $materialId,
            'quantidade' => 1,
            'quantidade_devolvida' => 0,
        ]);

        $response = $this->postJson('/api/cadastro_devolucao', [
            'id_emprestimo' => $emprestimoId,
            'data_devolucao' => now()->toDateTimeString(),
            'observacao' => 'Devolvido no prazo',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('emprestimo.id', $emprestimoId)
            ->assertJsonPath('emprestimo.status', 'devolvido');

        $this->assertDatabaseHas('emprestimos', [
            'id' => $emprestimoId,
            'status' => 'devolvido',
        ]);
    }

    public function test_can_register_equipment_material(): void
    {
        if (! Schema::hasTable('categorias')) {
            Schema::create('categorias', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('localizacoes')) {
            Schema::create('localizacoes', function (Blueprint $table) {
                $table->id();
                $table->string('nome');
                $table->timestamps();
            });
        }

        $categoriaId = DB::table('categorias')->insertGetId([
            'nome' => 'Eletrônicos',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $localizacaoId = DB::table('localizacoes')->insertGetId([
            'nome' => 'Almoxarifado',
            'codigo' => 'LOC-ALMOX',
            'descricao' => 'Local de teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->postJson('/api/cadastro_equipamentos', [
            'codigo' => 'EQ-001',
            'nome' => 'Notebook Dell',
            'descricao' => 'Notebook para uso geral',
            'id_categoria' => $categoriaId,
            'id_localizacao' => $localizacaoId,
            'quantidade' => 3,
            'quantidade_disponivel' => 3,
            'quantidade_minima' => 1,
            'marca' => 'Dell',
            'modelo' => 'Latitude',
            'status' => 'disponivel',
            'observacoes' => 'Equipamento em bom estado',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('equipamento.nome', 'Notebook Dell');

        $this->assertDatabaseHas('materiais', [
            'codigo' => 'EQ-001',
            'nome' => 'Notebook Dell',
        ]);
    }
}
