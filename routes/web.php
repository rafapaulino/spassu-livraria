<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\RelatorioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
Route::get('/assunto/select2', [AssuntoController::class, 'select2'])->name('assunto.select2');
Route::get('/autor/select2', [AutorController::class, 'select2'])->name('autor.select2');
Route::resource('assunto', AssuntoController::class);
Route::resource('autor', AutorController::class);
Route::resource('livro', LivroController::class);

