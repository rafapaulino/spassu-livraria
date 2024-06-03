<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssuntoRequest;
use App\Services\AssuntoService;

class AssuntoController extends Controller
{
    public function __construct(
        public AssuntoService $assuntoService
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assuntos = $this->assuntoService->list(10);
        return view('assunto.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assunto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssuntoRequest $request)
    {
        $this->assuntoService->store($request);
        
        return redirect()->route('assunto.index')
                         ->with('success', 'Assunto criado com sucesso.');
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
        $this->assuntoService->destroy($id);

        return redirect()->route('assunto.index')
                         ->with('success', 'Assunto deletado com sucesso.');
    }
}
