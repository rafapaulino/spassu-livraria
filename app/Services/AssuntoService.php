<?php 

namespace App\Services;

use App\Models\Assunto;

class AssuntoService
{
    public function get($total = 15)
    {
        return Assunto::orderBy('descricao', 'asc')->take($total)->get();
    }

    public function list($total = 10)
    {
        return Assunto::orderBy('descricao', 'asc')->paginate($total);
    }

    public function store($request)
    {
        Assunto::create($request->all());
    }

    public function find($id)
    {
        return Assunto::findOrFail($id);
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