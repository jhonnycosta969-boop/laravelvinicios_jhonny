<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Localizacao extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
        'descricao',
        'codigo',
        'ativo',
    ];

    protected $table = 'localizacoes';

    public $timestamps = false;

    public function materiais(): HasMany
    {
        return $this->hasMany(Material::class, 'id_localizacao');
    }
}
