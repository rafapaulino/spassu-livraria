<?php

namespace Tests\Feature;

use App\Models\Assunto;
use App\Services\AssuntoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AssuntoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $assuntoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->assuntoService = $this->createMock(AssuntoService::class);
        $this->app->instance(AssuntoService::class, $this->assuntoService);
    }

    public function testCreate()
    {
        $response = $this->get(route('assunto.create'));

        $response->assertStatus(200);
        $response->assertViewIs('assunto.create');
    }

    public function testStore()
    {
        $request = Assunto::factory()->make()->toArray();

        $this->assuntoService->expects($this->once())
            ->method('store')
            ->with($this->callback(function ($req) use ($request) {
                return $req->all() == $request;
            }));

        $response = $this->post(route('assunto.store'), $request);

        $response->assertRedirect(route('assunto.index'));
        $response->assertSessionHas('success', 'O assunto foi criado com sucesso.');
    }

    public function testEdit()
    {
        $assunto = Assunto::factory()->create();

        $this->assuntoService->method('find')->willReturn($assunto);

        $response = $this->get(route('assunto.edit', $assunto->id));

        $response->assertStatus(200);
        $response->assertViewIs('assunto.edit');
        $response->assertViewHas('assunto');
    }

    public function testEditNotFound()
    {
        $this->assuntoService->method('find')->willThrowException(new \Exception());

        $response = $this->get(route('assunto.edit', 999));

        $response->assertRedirect(route('assunto.index'));
        $response->assertSessionHas('error', 'Assunto não encontrado.');
    }

    public function testUpdate()
    {
        $assunto = Assunto::factory()->create();
        $request = Assunto::factory()->make()->toArray();

        $this->assuntoService->expects($this->once())
            ->method('update')
            ->with($this->callback(function ($req) use ($request) {
                return $req->all() == $request;
            }), $assunto->id);

        $response = $this->put(route('assunto.update', $assunto->id), $request);

        $response->assertRedirect(route('assunto.index'));
        $response->assertSessionHas('success', 'O assunto foi atualizado com sucesso.');
    }

    public function testUpdateNotFound()
    {
        $this->assuntoService->method('update')->willThrowException(new \Exception());

        $response = $this->put(route('assunto.update', 999), [
            'descricao' => 'Novo'
        ]);

        $response->assertRedirect(route('assunto.index'));
        $response->assertSessionHas('error', 'Assunto não encontrado.');
    }

    public function testDestroy()
    {
        $assunto = Assunto::factory()->create();

        $this->assuntoService->expects($this->once())
            ->method('destroy')
            ->with($assunto->id);

        $response = $this->delete(route('assunto.destroy', $assunto->id));

        $response->assertRedirect(route('assunto.index'));
        $response->assertSessionHas('success', 'O assunto foi deletado com sucesso.');
    }

    public function testDestroyNotFound()
    {
        $this->assuntoService->method('destroy')->willThrowException(new \Exception());

        $response = $this->delete(route('assunto.destroy', 999));

        $response->assertRedirect(route('assunto.index'));
        $response->assertSessionHas('error', 'Assunto não encontrado.');
    }

    public function testSelect2()
    {
        $request = new Request(['q' => 'test']);
        $expectedResponse = [
            'results' => [
                ['id' => 1, 'text' => 'Test Assunto']
            ],
            'pagination' => ['more' => false]
        ];

        $this->assuntoService->method('select2')->willReturn($expectedResponse);

        $response = $this->getJson(route('assunto.select2', $request->all()));

        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }
}