<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'codigo',
        'nome',
        'descricao',
        'id_categoria',
        'id_localizacao',
        'quantidade',
        'quantidade_disponivel',
        'quantidade_minima',
    ];

    protected $table = 'materiais';

    public $timestamps = false;

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function localizacao(): BelongsTo
    {
        return $this->belongsTo(Localizacao::class, 'id_localizacao');
    }

    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacao::class, 'id_material');
    }

    protected function casts(): array
    {
        return [
            'quantidade' => 'integer',
            'quantidade_disponivel' => 'integer',
            'quantidade_minima' => 'integer',
        ];
    }
}
