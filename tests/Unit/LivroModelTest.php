<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LivroModelTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_livro_create(): void
    {
        $data = [
            'titulo' => 'Teste',
            'preco' => 10.20,
            'editora' => 'Nova',
            'edicao' => 1,
            'ano_publicacao' => 2000
        ];
        
        Livro::factory()->create($data);

        $this->assertDatabaseHas('livros', $data);
    }

    public function test_livro_equal(): void
    {
        $livro = new Livro([
            'titulo' => 'Novo',
            'preco' => 10.20,
            'editora' => 'Velha',
            'edicao' => 1,
            'ano_publicacao' => 2000
        ]);

        $this->assertEquals('Novo', $livro->titulo);
    }

    public function test_livro_not_set(): void
    {
        $livro = new Livro([
            'titulo' => 'Novo',
            'preco' => 10.20,
            'editora' => 'Velha',
            'edicao' => 1,
            'ano_publicacao' => 2000,
            'attr' => 'Yes'
        ]);

        $this->assertArrayNotHasKey('attr', $livro->getAttributes());
    }

    public function test_livro_update(): void
    {
        $livro = Livro::factory()->create();
        $livro->titulo = "Atualizado";
        $livro->save();

        $this->assertEquals('Atualizado', $livro->titulo);
    }

    public function test_livro_deleted(): void
    {
        $livro = Livro::factory()->create();
        $livro->delete();

        $this->assertModelMissing($livro);
    }

    public function test_add_assunto_to_livro()
    {
        $livro = Livro::factory()->create();
        $assunto = Assunto::factory()->create();

        $livro->assuntos()->attach($assunto);

        $this->assertTrue($livro->assuntos->contains($assunto));
    }

    public function test_add_autor_to_livro()
    {
        $livro = Livro::factory()->create();
        $autor = Autor::factory()->create();

        $livro->autores()->attach($autor);

        $this->assertTrue($livro->autores->contains($autor));
    }
}
