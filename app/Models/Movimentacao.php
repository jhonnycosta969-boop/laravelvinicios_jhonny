<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimentacao extends Model
{
    protected $fillable = [
        'id_material',
        'id_usuario',
        'tipo',
        'quantidade',
        'data_hora',
        'observacao',
    ];

    protected $table = 'movimentacoes';

    public $timestamps = false;

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'id_material');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantidade' => 'integer',
            'data_hora' => 'datetime',
        ];
    }
}
