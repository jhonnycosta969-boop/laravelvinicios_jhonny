<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $table = 'emprestimos';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'data_retirada',
        'data_devolucao',
        'previsao_devolucao',
        'status',
        'observacao',
        'criado_em',
    ];
}
