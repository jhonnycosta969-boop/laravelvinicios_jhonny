<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $movimentacoes = Movimentacao::query()
            ->with(['material', 'usuario'])
            ->latest('data_hora')
            ->paginate();

        return response()->json($movimentacoes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_material' => ['required', 'integer', 'exists:materiais,id'],
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id'],
            'tipo' => ['required', 'in:entrada,saida,retirada,devolucao,perda,dano,ajuste,manutencao'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'data_hora' => ['required', 'date'],
            'observacao' => ['nullable', 'string'],
        ]);

        $movimentacao = Movimentacao::create($validated);

        return response()->json($movimentacao->load(['material', 'usuario']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movimentacao $movimentacao): JsonResponse
    {
        return response()->json($movimentacao->load(['material', 'usuario']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movimentacao $movimentacao): JsonResponse
    {
        $validated = $request->validate([
            'id_material' => ['sometimes', 'required', 'integer', 'exists:materiais,id'],
            'id_usuario' => ['sometimes', 'required', 'integer', 'exists:usuarios,id'],
            'tipo' => ['sometimes', 'required', 'in:entrada,saida,retirada,devolucao,perda,dano,ajuste,manutencao'],
            'quantidade' => ['sometimes', 'required', 'integer', 'min:1'],
            'data_hora' => ['sometimes', 'required', 'date'],
            'observacao' => ['sometimes', 'nullable', 'string'],
        ]);

        $movimentacao->update($validated);

        return response()->json($movimentacao->load(['material', 'usuario']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimentacao $movimentacao): Response
    {
        $movimentacao->delete();

        return response()->noContent();
    }
}
