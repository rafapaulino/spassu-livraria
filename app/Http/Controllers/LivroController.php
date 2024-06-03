<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LivroService;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->livroService->destroy($id);

        return redirect()->route('livro.index')
                         ->with('success', 'Livro deletado com sucesso.');
    }
}
