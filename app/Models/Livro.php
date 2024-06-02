<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'preco',
        'editora',
        'edicao',
        'ano_publicacao'
    ];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto');
    }
}
