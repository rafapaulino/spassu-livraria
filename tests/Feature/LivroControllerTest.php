<?php

namespace Tests\Feature;

use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $livroService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->livroService = $this->createMock(LivroService::class);
        $this->app->instance(LivroService::class, $this->livroService);
    }

    public function testCreate()
    {
        $response = $this->get(route('livro.create'));

        $response->assertStatus(200);
        $response->assertViewIs('livro.create');
    }

    public function testEdit()
    {
        $livro = Livro::factory()->create();

        $this->livroService->method('find')->willReturn($livro);

        $response = $this->get(route('livro.edit', ['livro' => $livro->id]));

        $response->assertStatus(200);
        $response->assertViewIs('livro.edit');
        $response->assertViewHas('livro', $livro);
    }

    public function testEditNotFound()
    {
        $this->livroService->method('find')->willThrowException(new \Exception());

        $response = $this->get(route('livro.edit', ['livro' => 999]));

        $response->assertRedirect(route('livro.index'));
        $response->assertSessionHas('error', 'Livro não encontrado.');
    }

    public function testUpdateNotFound()
    {
        $this->livroService->method('update')->willThrowException(new \Exception());

        $response = $this->put(route('livro.update', ['livro' => 999]), [
            'titulo' => 'New Livro',
            'preco' => 10.10,
            'editora' => 'Nova',
            'edicao' => 1,
            'ano_publicacao' => date("Y"),
            'assuntos' => ['Assunto 1', 'Assunto 2'],
            'autores' => ['Autor 1', 'Autor 2']
        ]);

        $response->assertRedirect(route('livro.index'));
        $response->assertSessionHas('error', 'Livro não encontrado.');
    }

    public function testDestroy()
    {
        $livro = Livro::factory()->create();

        $this->livroService->expects($this->once())
            ->method('destroy')
            ->with($livro->id);

        $response = $this->delete(route('livro.destroy', ['livro' => $livro->id]));

        $response->assertRedirect(route('livro.index'));
        $response->assertSessionHas('success', 'O livro foi deletado com sucesso.');
    }

    public function testDestroyNotFound()
    {
        $this->livroService->method('destroy')->willThrowException(new \Exception());

        $response = $this->delete(route('livro.destroy', ['livro' => 999]));

        $response->assertRedirect(route('livro.index'));
        $response->assertSessionHas('error', 'Livro não encontrado.');
    }
}
