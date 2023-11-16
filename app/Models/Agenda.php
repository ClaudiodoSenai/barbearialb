<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [    
        'profissional_id',
        'cliente_id',
        'servico_id',
        'data_hora',
        'tipoPagamento',
        'valor'
    ];
}
