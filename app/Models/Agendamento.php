<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    /** @use HasFactory<\Database\Factories\AgendamentoFactory> */
    use HasFactory;

    protected $fillable = [
        'rm',
        'id_revista',
        'dt_pegar',
        'dt_devolver',
    ];

    //FAZ O RELACIONAMENTO DE FOREIGN KEY
    public function user()
    {
        return $this->belongsTo(User::class, 'rm');
    }
}
