<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revista extends Model
{
    /** @use HasFactory<\Database\Factories\RevistaFactory> */
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descricao',
        'tema',
        'quantidade',
        'imagem',
        'edicao',
        'issn',
    ];
}
