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

    public function destroy($id)
    {
        $assunto = Assunto::find($id);
        $assunto->delete();
    }
}