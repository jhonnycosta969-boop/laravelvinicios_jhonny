<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemEmprestimo extends Model
{
    protected $table = 'itens_emprestimo';

    protected $fillable = [
        'id_emprestimo',
        'id_material',
        'quantidade',
        'quantidade_devolvida',
    ];

    public $timestamps = false;

    public function emprestimo(): BelongsTo
    {
        return $this->belongsTo(Emprestimo::class, 'id_emprestimo');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
}
