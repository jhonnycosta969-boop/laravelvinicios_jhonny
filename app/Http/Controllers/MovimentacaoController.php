<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class MovimentacaoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Movimentacao::latest('data_hora')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id_material' => 'required|exists:materiais,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'tipo' => 'required|string',
            'quantidade' => 'required|integer|min:1',
            'data_hora' => 'required|date',
            'observacao' => 'nullable|string',
        ]);

        $movimentacao = Movimentacao::create($dados);

        return response()->json($movimentacao, 201);
    }

    public function show(Movimentacao $movimentacao): JsonResponse
    {
        return response()->json($movimentacao);
    }

    public function update(Request $request, Movimentacao $movimentacao): JsonResponse
    {
        $dados = $request->validate([
            'id_material' => ['sometimes', 'required', 'exists:materiais,id'],
            'id_usuario' => ['sometimes', 'required', 'exists:usuarios,id'],
            'tipo' => ['sometimes', 'required', Rule::in(['entrada', 'saida', 'retirada', 'devolucao', 'perda', 'dano', 'ajuste', 'manutencao'])],
            'quantidade' => ['sometimes', 'required', 'integer', 'min:1'],
            'data_hora' => ['sometimes', 'required', 'date'],
            'observacao' => ['sometimes', 'nullable', 'string'],
        ]);

        $movimentacao->update($dados);

        return response()->json($movimentacao->refresh());
    }

    public function destroy(Movimentacao $movimentacao): Response
    {
        $movimentacao->delete();

        return response()->noContent();
    }
}
