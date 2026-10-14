<?php

use App\Models\Movimentacao;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/carrinhos', function () {
    return view('carrinhos');
})->name('carrinhos');

Route::get('/notebooks', function () {
    return view('notebooks');
})->name('notebooks');

Route::get('/retiradas', function () {
    return view('retiradas');
})->name('retiradas');

Route::get('/devolucoes', function () {
    return view('devolucoes');
})->name('devolucoes');

Route::get('/usuarios', function () {
    return view('usuarios');
})->name('usuarios');

Route::get('/relatorios', function () {
    return view('relatorios');
})->name('relatorios');

Route::get('/movimentacoes', function () {
    $tabelaDisponivel = Schema::hasTable('movimentacoes');
    $movimentacoes = $tabelaDisponivel
        ? Movimentacao::query()->latest('data_hora')->paginate(10)
        : null;

    return view('movimentacoes', compact('movimentacoes', 'tabelaDisponivel'));
})->name('movimentacoes.pagina');
