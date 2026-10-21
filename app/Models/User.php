<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'tipo_usuario',
        'ativo',
        'data_cadastro',
    ];

    protected $hidden = ['senha', 'remember_token'];

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
            'ativo' => 'boolean',
            'data_cadastro' => 'datetime',
        ];
    }

    public function salvar_usuario(Request $request): self
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'senha' => ['required', 'string', 'min:8'],
        ]);

        return self::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
        ]);
    }
}
