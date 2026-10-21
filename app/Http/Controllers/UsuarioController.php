<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;    
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function cadastro_usuario(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email',
            'senha' => 'required|string|min:8',
            'cpf' => 'required|string|size:11|',
            'data_nascimento' => 'nullable|date'
        ]);

        $usuario = Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => $dados['senha'],
            'cpf' => $dados['cpf'],
            'data_nascimento' => $dados['data_nascimento'] ?? null,
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'usuario' => $usuario,
        ], 201);
    }

    public function salvar_usuario(Request $request): JsonResponse
    {
        return $this->cadastro_usuario($request);
    }

    public function ver_usuario(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id' => ['required', 'integer', 'exists:usuarios,id'],
        ]);

        return response()->json([
            'usuario' => Usuario::findOrFail($dados['id']),
            'erro' => 'n',
        ]);
    }

    public function listar_usuarios(): JsonResponse
    {
        return response()->json([
            'usuarios' => Usuario::all(),
            'erro' => 'n',
        ]);
    }

    public function listar_usuarios_simples(): JsonResponse
    {
        return response()->json([
            'usuarios' => Usuario::query()->select('nome', 'email')->get(),
            'erro' => 'n',
        ]);
    }

    public function alterar_usuario(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id' => ['required', 'integer', 'exists:usuarios,id'],
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios', 'email')->ignore($request->input('id'))],
            'senha' => ['nullable', 'string', 'min:8'],
            'tipo_usuario' => ['sometimes', Rule::in(['administrador', 'responsavel', 'professor'])],
            'tipo' => ['sometimes', Rule::in(['administrador', 'responsavel', 'professor'])],
        ]);

        $usuario = Usuario::findOrFail($dados['id']);
        $usuario->nome = $dados['nome'];
        $usuario->email = $dados['email'];

        if (! empty($dados['senha'])) {
            $usuario->senha = $dados['senha'];
        }

        if (isset($dados['tipo_usuario']) || isset($dados['tipo'])) {
            $usuario->tipo_usuario = $dados['tipo_usuario'] ?? $dados['tipo'];
        }

        $usuario->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'usuario' => $usuario,
            'erro' => 'n',
        ]);
    }

    public function deletar_usuario(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'id' => ['required', 'integer', 'exists:usuarios,id'],
        ]);

        Usuario::findOrFail($dados['id'])->delete();

        return response()->json([
            'message' => 'Usuário deletado com sucesso!',
            'erro' => 'n',
        ]);
    }
}
