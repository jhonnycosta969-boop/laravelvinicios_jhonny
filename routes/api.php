<?php

use App\Http\Controllers\MovimentacaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('movimentacoes', MovimentacaoController::class)
    ->parameters(['movimentacoes' => 'movimentacao'])
    ->middleware('auth:sanctum');
