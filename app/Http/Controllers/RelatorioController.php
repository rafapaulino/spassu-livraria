<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoresLivrosView;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function index()
    {
        $dados = AutoresLivrosView::all();
        $pdf = Pdf::loadView('relatorio.index', compact('dados'));
        return $pdf->download('relatorio_livros_autores.pdf');
    }
}
