<?php

namespace Tests\Feature;

use App\Models\Assunto;
use App\Services\AssuntoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssuntoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $assuntoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->assuntoService = new AssuntoService();
    }

    public function testGet()
    {
        Assunto::factory()->count(20)->create();

        $result = $this->assuntoService->get(15);

        $this->assertCount(15, $result);
        $this->assertEquals('id', $result->first()->getKeyName());
    }

    public function testList()
    {
        Assunto::factory()->count(20)->create();

        $result = $this->assuntoService->list(10);

        $this->assertCount(10, $result);
        $this->assertTrue($result->hasMorePages());
    }

    public function testSelect2()
    {
        Assunto::factory()->create(['descricao' => 'Test Assunto']);

        $request = new \Illuminate\Http\Request(['q' => 'Test', 'page' => 1]);

        $result = $this->assuntoService->select2($request);

        $this->assertCount(1, $result['results']);
        $this->assertEquals('Test Assunto', $result['results'][0]['text']);
        $this->assertFalse($result['pagination']['more']);
    }

    public function testStore()
    {
        $request = new \Illuminate\Http\Request(['descricao' => 'New Assunto']);

        $this->assuntoService->store($request);

        $this->assertDatabaseHas('assuntos', ['descricao' => 'New Assunto']);
    }

    public function testFind()
    {
        $assunto = Assunto::factory()->create();

        $result = $this->assuntoService->find($assunto->id);

        $this->assertEquals($assunto->id, $result->id);
    }

    public function testUpdate()
    {
        $assunto = Assunto::factory()->create(['descricao' => 'Old Assunto']);
        $request = new \Illuminate\Http\Request(['descricao' => 'Updated Assunto']);

        $this->assuntoService->update($request, $assunto->id);

        $this->assertDatabaseHas('assuntos', ['descricao' => 'Updated Assunto']);
    }

    public function testDestroy()
    {
        $assunto = Assunto::factory()->create();

        $this->assuntoService->destroy($assunto->id);

        $this->assertDatabaseMissing('assuntos', ['id' => $assunto->id]);
    }
}