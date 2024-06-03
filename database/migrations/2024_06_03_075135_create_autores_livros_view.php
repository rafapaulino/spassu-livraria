<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW autores_livros_view AS
            SELECT 
                a.nome AS autor,
                l.titulo AS livro,
                l.editora AS editora,
                CONCAT('R$ ', FORMAT(l.preco, 2, 'pt_BR')) AS preco,
                l.ano_publicacao,
                (
                    SELECT 
                        GROUP_CONCAT(ass.descricao SEPARATOR ', ') AS assunto
                    FROM 
                        assuntos ass
                    JOIN 
                        livro_assunto la ON ass.id = la.assunto_id
                    WHERE 
                        la.livro_id = l.id
                ) AS assunto
            FROM 
                autors a
            JOIN 
                livro_autor la ON a.id = la.autor_id
            JOIN 
                livros l ON la.livro_id = l.id
            ORDER BY 
                a.nome ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS autores_livros_view");
    }
};
