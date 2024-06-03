<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LivroService;
use App\Http\Requests\LivroRequest;
use Exception;

class LivroController extends Controller
{
    public function __construct(
        public LivroService $livroService
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = $this->livroService->list(10);
        return view('livro.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LivroRequest $request)
    {

        $this->livroService->store($request);

        return redirect()->route('livro.index')
                         ->with('success', 'O livro foi criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            
            $livro = $this->livroService->find($id);
            return view('livro.edit', compact('livro'));
        
        } catch (Exception $e) {
            return redirect()->route('livro.index')
                ->with('error', 'Livro não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivroRequest $request, string $id)
    {
        try {

            $this->livroService->update($request, $id);
            return redirect()->route('livro.index')
                            ->with('success', 'O livro foi atualizado com sucesso.');

        } catch (Exception $e) {
            return redirect()->route('livro.index')
                ->with('error', 'Livro não encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->livroService->destroy($id);

            return redirect()->route('livro.index')
                ->with('success', 'O livro foi deletado com sucesso.');

        } catch (Exception $e) {
            return redirect()->route('livro.index')
                ->with('error', 'Livro não encontrado.');
        }
    }
}
