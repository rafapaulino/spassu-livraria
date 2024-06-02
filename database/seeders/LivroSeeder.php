<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Livro::factory()
            ->has(Autor::factory()->count(2), 'autores')
            ->has(Assunto::factory()->count(2), 'assuntos')
            ->count(15)
            ->create();
    }
}
