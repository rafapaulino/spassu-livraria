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

    public function select2($request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 10;

        $query = Autor::query();

        if ($search) {
            $query->where('nome', 'like', '%' . $search . '%');
        }

        $results = $query->paginate($perPage, ['*'], 'page', $page);

        $formattedResults = [];
        foreach ($results->items() as $autor) {
            $formattedResults[] = [
                'id' => $autor->id,
                'text' => $autor->nome,
            ];
        }

        return [
            'results' => $formattedResults,
            'pagination' => [
                'more' => $results->hasMorePages(),
            ],
        ];
    }

    public function store($request)
    {
        Autor::create($request->all());
    }

    public function find($id)
    {
        return Autor::findOrFail($id);
    }

    public function update($request, $id)
    {
        $autor = $this->find($id);
        $autor->update($request->all());
    }

    public function destroy($id)
    {
        $autor = $this->find($id);
        $autor->delete();
    }
}