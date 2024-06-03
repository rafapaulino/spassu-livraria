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

    public function select2($request)
    {
        $search = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 10;

        $query = Assunto::query();

        if ($search) {
            $query->where('descricao', 'like', '%' . $search . '%');
        }

        $results = $query->paginate($perPage, ['*'], 'page', $page);

        $formattedResults = [];
        foreach ($results->items() as $assunto) {
            $formattedResults[] = [
                'id' => $assunto->id,
                'text' => $assunto->descricao,
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