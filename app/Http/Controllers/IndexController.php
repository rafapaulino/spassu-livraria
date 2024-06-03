<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IndexService;

class IndexController extends Controller
{
    protected $service;

    public function __construct(IndexService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $autores = $this->service->getAutores();
        $assuntos = $this->service->getAssuntos();

        return view('index.home', compact('autores','assuntos'));
    }
}
