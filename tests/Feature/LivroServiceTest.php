<?php

namespace Tests\Feature;

use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;

class LivroServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $livroService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->livroService = new LivroService();
    }

    public function testList()
    {
        Livro::factory()->count(20)->create();

        $result = $this->livroService->list(15);

        $this->assertCount(15, $result);
        $this->assertTrue($result->hasMorePages());
    }

    public function testStore()
    {
        $request = new Request([
            'titulo' => 'New Livro',
            'preco' => 10.10,
            'editora' => 'Nova',
            'edicao' => 1,
            'ano_publicacao' => date("Y"),
            'assuntos' => ['Assunto 1', 'Assunto 2'],
            'autores' => ['Autor 1', 'Autor 2']
        ]);

        $this->livroService->store($request);

        $this->assertDatabaseHas('livros', ['titulo' => 'New Livro']);
        $this->assertDatabaseHas('assuntos', ['descricao' => 'Assunto 1']);
        $this->assertDatabaseHas('autors', ['nome' => 'Autor 1']);
    }

    public function testAttachAssunto()
    {
        $livro = Livro::factory()->create();
        $request = new Request(['assuntos' => ['Assunto 1', 'Assunto 2']]);

        $this->livroService->attachAssunto($livro, $request);

        $this->assertDatabaseHas('assuntos', ['descricao' => 'Assunto 1']);
        $this->assertDatabaseHas('livro_assunto', ['livro_id' => $livro->id]);
    }

    public function testAttachAutor()
    {
        $livro = Livro::factory()->create();
        $request = new Request(['autores' => ['Autor 1', 'Autor 2']]);

        $this->livroService->attachAutor($livro, $request);

        $this->assertDatabaseHas('autors', ['nome' => 'Autor 1']);
        $this->assertDatabaseHas('livro_autor', ['livro_id' => $livro->id]);
    }

    public function testFind()
    {
        $livro = Livro::factory()->create();

        $result = $this->livroService->find($livro->id);

        $this->assertEquals($livro->id, $result->id);
    }

    public function testUpdate()
    {
        $livro = Livro::factory()->create([
            'titulo' => 'Old Livro',
            'preco' => 300.10,
            'editora' => 'Nova',
            'edicao' => 1,
            'ano_publicacao' => date("Y"),
        ]);
        $request = new Request([
            'titulo' => 'Updated Livro',
            'assuntos' => ['Updated Assunto'],
            'autores' => ['Updated Autor']
        ]);

        $this->livroService->update($request, $livro->id);

        $this->assertDatabaseHas('livros', ['titulo' => 'Updated Livro']);
        $this->assertDatabaseHas('assuntos', ['descricao' => 'Updated Assunto']);
        $this->assertDatabaseHas('autors', ['nome' => 'Updated Autor']);
    }

    public function testDestroy()
    {
        $livro = Livro::factory()->create();

        $this->livroService->destroy($livro->id);

        $this->assertDatabaseMissing('livros', ['id' => $livro->id]);
    }
}