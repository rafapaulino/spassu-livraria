<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assunto;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Assunto::create([
            'descricao' => 'HTML',
        ]);

        Assunto::create([
            'descricao' => 'CSS',
        ]);

        Assunto::create([
            'descricao' => 'PHP',
        ]);

        Assunto::create([
            'descricao' => 'JavaScript',
        ]);

        Assunto::create([
            'descricao' => 'Scrum',
        ]);

        Assunto::create([
            'descricao' => 'Linux',
        ]);

        Assunto::create([
            'descricao' => 'Docker',
        ]);

        Assunto::create([
            'descricao' => 'VueJs',
        ]);

        Assunto::create([
            'descricao' => 'SASS',
        ]);

        Assunto::create([
            'descricao' => 'React',
        ]);

        Assunto::create([
            'descricao' => 'Marketing Digital',
        ]);
    }
}
