<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AutorService;
use App\Http\Requests\AutorRequest;
use Exception;

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
        return view('autor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutorRequest $request)
    {
        $this->autorService->store($request);

        return redirect()->route('autor.index')
                         ->with('success', 'O autor foi criado com sucesso.');
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
            
            $autor = $this->autorService->find($id);
            return view('autor.edit', compact('autor'));
        
        } catch (Exception $e) {
            return redirect()->route('autor.index')
                ->with('error', 'Autor não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AutorRequest $request, string $id)
    {
        try {

            $this->autorService->update($request, $id);
            return redirect()->route('autor.index')
                            ->with('success', 'O autor foi atualizado com sucesso.');

        } catch (Exception $e) {
            return redirect()->route('autor.index')
                ->with('error', 'Autor não encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->autorService->destroy($id);

            return redirect()->route('autor.index')
                ->with('success', 'O autor foi deletado com sucesso.');

        } catch (Exception $e) {
            return redirect()->route('autor.index')
                ->with('error', 'Autor não encontrado.');
        }
    }
}
