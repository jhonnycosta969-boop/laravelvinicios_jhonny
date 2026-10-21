<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucao extends Model
{
    protected $table = 'devolucoes';

    protected $fillable = [
        'id_emprestimo',
        'data_devolucao',
        'observacao',
    ];

    public $timestamps = false;

    protected $casts = [
        'data_devolucao' => 'datetime',
    ];
}
