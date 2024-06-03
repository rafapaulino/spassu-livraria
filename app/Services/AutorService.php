<?php 

namespace App\Services;

use App\Models\Autor;

class AutorService
{
    public function get($total = 15)
    {
        return Autor::orderBy('nome', 'asc')->take($total)->get();
    }

    public function list($total = 10)
    {
        return Autor::orderBy('nome', 'asc')->paginate($total);
    }

    public function destroy($id)
    {
        $autor = Autor::find($id);
        $autor->delete();
    }
}