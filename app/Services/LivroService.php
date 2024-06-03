<?php 

namespace App\Services;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class LivroService
{
    public function list($total = 15)
    {
        return Livro::orderBy('titulo', 'asc')->paginate($total);
    }

    public function store($request)
    {
        $livro = Livro::create($request->all());

        $this->attachAssunto($livro, $request);
        $this->attachAutor($livro, $request);
    }

    public function attachAssunto($livro, $request)
    {
        foreach ($request->input('assuntos') as $assunto)
        {
            if (is_numeric($assunto)) {
                $livro->assuntos()->attach($assunto);
            } else {
                $novoAssunto = Assunto::create(['descricao' => $assunto]);
                $livro->assuntos()->attach($novoAssunto->id);
            }
        }
    }

    public function attachAutor($livro, $request)
    {
        foreach ($request->input('autores') as $autor)
        {
            if (is_numeric($autor)) {
                $livro->autores()->attach($autor);
            } else {
                $novoAutor = Autor::create(['nome' => $autor]);
                $livro->autores()->attach($novoAutor->id);
            }
        }
    }

    public function find($id)
    {
        return Livro::findOrFail($id);
    }

    public function update($request, $id)
    {
        $assunto = $this->find($id);
        $assunto->update($request->all());
    }

    public function destroy($id)
    {
        $assunto = $this->find($id);
        $assunto->delete();
    }
}