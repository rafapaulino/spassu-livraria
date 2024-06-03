<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssuntoRequest;
use App\Services\AssuntoService;
use Exception;

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
                         ->with('success', 'O assunto foi criado com sucesso.');
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
            
            $assunto = $this->assuntoService->find($id);
            return view('assunto.edit', compact('assunto'));
        
        } catch (Exception $e) {
            return redirect()->route('assunto.index')
                ->with('error', 'Assunto não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssuntoRequest $request, string $id)
    {
        try {

            $this->assuntoService->update($request, $id);
            return redirect()->route('assunto.index')
                            ->with('success', 'O assunto foi atualizado com sucesso.');

        } catch (Exception $e) {
            return redirect()->route('assunto.index')
                ->with('error', 'Assunto não encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->assuntoService->destroy($id);

            return redirect()->route('assunto.index')
                ->with('success', 'O assunto foi deletado com sucesso.');

        } catch (Exception $e) {
            return redirect()->route('assunto.index')
                ->with('error', 'Assunto não encontrado.');
        }
    }


    public function select2(Request $request)
    {
        $json = $this->assuntoService->select2($request);
        return response()->json($json);
    }
}
