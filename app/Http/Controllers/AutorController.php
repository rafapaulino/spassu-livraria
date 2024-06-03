<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AutorService;

class AutorController extends Controller
{
    public function __construct(
        public AutorService $autorService
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autores = $this->autorService->list(10);
        return view('autor.index', compact('autores'));
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
        $this->autorService->destroy($id);

        return redirect()->route('autor.index')
                         ->with('success', 'Autor deletado com sucesso.');
    }
}
