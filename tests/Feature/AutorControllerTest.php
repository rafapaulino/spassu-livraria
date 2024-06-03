<?php

namespace Tests\Feature;

use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $autorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->autorService = $this->createMock(AutorService::class);
        $this->app->instance(AutorService::class, $this->autorService);
    }

    public function testCreate()
    {
        $response = $this->get(route('autor.create'));

        $response->assertStatus(200);
        $response->assertViewIs('autor.create');
    }

    public function testStore()
    {
        $request = Autor::factory()->make()->toArray();

        $this->autorService->expects($this->once())
            ->method('store')
            ->with($this->callback(function ($req) use ($request) {
                return $req->all() == $request;
            }));

        $response = $this->post(route('autor.store'), $request);

        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('success', 'O autor foi criado com sucesso.');
    }

    public function testEdit()
    {
        $autor = Autor::factory()->create();

        $this->autorService->method('find')->willReturn($autor);

        $response = $this->get(route('autor.edit', ['autor' => $autor->id]));

        $response->assertStatus(200);
        $response->assertViewIs('autor.edit');
        $response->assertViewHas('autor');
    }

    public function testEditNotFound()
    {
        $this->autorService->method('find')->willThrowException(new \Exception());

        $response = $this->get(route('autor.edit', ['autor' => 999]));

        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('error', 'Autor não encontrado.');
    }

    public function testUpdate()
    {
        $autor = Autor::factory()->create(['nome' => 'Old Autor']);
        $request = Autor::factory()->make()->toArray();

        $this->autorService->expects($this->once())
            ->method('update')
            ->with($this->callback(function ($req) use ($request) {
                return $req->all() == $request;
            }), $autor->id);

        $response = $this->put(route('autor.update', ['autor' => $autor->id]), $request);

        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('success', 'O autor foi atualizado com sucesso.');
    }

    public function testUpdateNotFound()
    {
        $this->autorService->method('update')->willThrowException(new \Exception());

        $response = $this->put(route('autor.update', ['autor' => 999]), [
            'nome' => 'Teste'
        ]);

        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('error', 'Autor não encontrado.');
    }

    public function testDestroy()
    {
        $autor = Autor::factory()->create();

        $this->autorService->expects($this->once())
            ->method('destroy')
            ->with($autor->id);

        $response = $this->delete(route('autor.destroy', ['autor' => $autor->id]));

        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('success', 'O autor foi deletado com sucesso.');
    }

    public function testDestroyNotFound()
    {
        $this->autorService->method('destroy')->willThrowException(new \Exception());

        $response = $this->delete(route('autor.destroy', ['autor' => 999]));

        $response->assertRedirect(route('autor.index'));
        $response->assertSessionHas('error', 'Autor não encontrado.');
    }

    public function testSelect2()
    {
        $request = new Request(['q' => 'test']);
        $expectedResponse = [
            'results' => [
                ['id' => 1, 'text' => 'Test Autor']
            ],
            'pagination' => ['more' => false]
        ];

        $this->autorService->method('select2')->willReturn($expectedResponse);

        $response = $this->getJson(route('autor.select2', $request->all()));

        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }
}
