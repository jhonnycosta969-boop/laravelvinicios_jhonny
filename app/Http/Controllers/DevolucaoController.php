<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class DevolucaoController extends Controller
{
    public function cadastro_devolucao(Request $request)
    {
        $dados = $request->validate([
            'id_emprestimo' => 'required|exists:emprestimos,id',
            'data_devolucao' => 'required|date',
            'observacao' => 'nullable|string',
        ]);

        $emprestimo = Emprestimo::with('itens')->findOrFail($dados['id_emprestimo']);

        $emprestimo->update([
            'data_devolucao' => $dados['data_devolucao'],
            'status' => 'devolvido',
            'observacao' => $dados['observacao'] ?? $emprestimo->observacao,
        ]);

        foreach ($emprestimo->itens as $item) {
            $item->update([
                'quantidade_devolvida' => $item->quantidade,
            ]);
        }

        return response()->json([
            'message' => 'Devolução registrada com sucesso!',
            'emprestimo' => $emprestimo->load('itens.material'),
        ], 201);
    }
}
