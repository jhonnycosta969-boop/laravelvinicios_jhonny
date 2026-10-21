<?php

use App\Http\Controllers\DevolucaoController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('movimentacoes', MovimentacaoController::class)
    ->parameters(['movimentacoes' => 'movimentacao'])
    ->middleware('auth:sanctum');

Route::post('/cadastro_usuario', [UsuarioController::class, 'cadastro_usuario']);
Route::post('/cadastro_emprestimo', [EmprestimoController::class, 'cadastro_emprestimo']);
Route::post('/cadastro_devolucao', [DevolucaoController::class, 'cadastro_devolucao']);
Route::post('/cadastro_materiais', [MaterialController::class, 'cadastro_materiais'])->name('cadastro_materiais');

Route::post('/usuario_cadastro', [UsuarioController::class, 'salvar_usuario'])->name('usuario_cadastro');

Route::get('/ver_usuario', [UsuarioController::class, 'ver_usuario'])->name('ver_usuario');
Route::get('/listar_usuarios', [UsuarioController::class, 'listar_usuarios'])->name('listar_usuarios');
Route::get('/listar_usuarios_simples', [UsuarioController::class, 'listar_usuarios_simples'])->name('listar_usuarios_simples');
Route::put('/alterar_usuario', [UsuarioController::class, 'alterar_usuario'])->name('alterar_usuario');
Route::delete('/deletar_usuario', [UsuarioController::class, 'deletar_usuario'])->name('deletar_usuario');

Route::post('/emprestimo_cadastro', [EmprestimoController::class, 'cadastrar_emprestimo'])->name('emprestimo_cadastro');
Route::get('/listar_emprestimos', [EmprestimoController::class, 'listar_emprestimos'])->name('listar_emprestimos');
Route::get('/ver_emprestimo/{id}', [EmprestimoController::class, 'ver_emprestimo'])->name('ver_emprestimo');
Route::put('/alterar_emprestimo/{id}', [EmprestimoController::class, 'alterar_emprestimo'])->name('alterar_emprestimo');
Route::delete('/deletar_emprestimo/{id}', [EmprestimoController::class, 'deletar_emprestimo'])->name('deletar_emprestimo');
      