<?php 

namespace App\Services;

use App\Models\Livro;

class LivroService
{
    public function list($total = 15)
    {
        return Livro::orderBy('titulo', 'asc')->paginate($total);
    }

    public function destroy($id)
    {
        $livro = Livro::find($id);
        $livro->delete();
    }
}