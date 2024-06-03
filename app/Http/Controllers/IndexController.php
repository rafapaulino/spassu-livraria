<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LivroService;
use App\Services\AssuntoService;
use App\Services\AutorService;

class IndexController extends Controller
{
    public function __construct(
        public AssuntoService $assuntoService,
        public AutorService $autorService,
        public LivroService $livroService
    ) { }

    public function index()
    {
        $autores = $this->autorService->get();
        $assuntos = $this->assuntoService->get();
        $livros = $this->livroService->list(6);

        return view('index.home', compact('autores','assuntos','livros'));
    }
}
