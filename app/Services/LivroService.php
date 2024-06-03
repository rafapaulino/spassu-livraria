<?php 

namespace App\Services;

use App\Models\Livro;

class LivroService
{
    public function list($total = 15)
    {
        return Livro::orderBy('titulo', 'asc')->paginate($total);
    }

    public function store($request)
    {
        Livro::create($request->all());
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