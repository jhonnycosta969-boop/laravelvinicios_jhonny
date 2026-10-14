<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = [
        'codigo',
        'nome',
        'descricao',
        'tipo',
        'ordem',
        'categoria_pai_id',
        'ativo',
        'observacoes',
    ];

    protected $table = 'categorias';

    public $timestamps = true;

    public function materiais(): HasMany
    {
        return $this->hasMany(Material::class, 'id_categoria');
    }

    public function categoriaPai(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'categoria_pai_id');
    }
    public function categoriasFilhas(): HasMany 
    {
        return $this->hasMany(self::class, 'categoria_pai_id');
    }      

}