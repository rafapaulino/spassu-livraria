<?php 

namespace App\Services;

use App\Models\Autor;
use App\Models\Assunto;
use App\Models\Livro;

class IndexService
{
    public function getAutores()
    {
        return Autor::orderBy('nome', 'asc')->take(15)->get();
    }

    public function getAssuntos()
    {
        return Assunto::orderBy('descricao', 'asc')->take(15)->get();
    }

    public function getLivros()
    {
        return Livro::orderBy('titulo', 'asc')->paginate(6);
    }
}