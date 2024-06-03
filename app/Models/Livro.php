<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function getImagem()
    {
        $id = rand(1, 40);
        return "https://picsum.photos/id/{$id}/500/500";
    }


    protected function preco(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value, 2, ',', '.'),
        );
    }
}
