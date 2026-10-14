<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nome',
        'email',                     
        'senha',
        'tipo_usuario', 
        'ativo', 
        'data_cadastro',
    ];

    protected $hidden = ['senha', 'remember_token'];

    protected $table = 'usuarios';

    public $timestamps = false;

    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacao::class, 'id_usuario');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'senha' => 'hashed',
            'ativo' => 'boolean',
            'data_cadastro' => 'datetime',
        ];
    }
}
