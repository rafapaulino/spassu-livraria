<?php

namespace Tests\Feature;

use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutorServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $autorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->autorService = new AutorService();
    }

    public function testGet()
    {
        Autor::factory()->count(20)->create();

        $result = $this->autorService->get(15);

        $this->assertCount(15, $result);
        $this->assertEquals('id', $result->first()->getKeyName());
    }

    public function testList()
    {
        Autor::factory()->count(20)->create();

        $result = $this->autorService->list(10);

        $this->assertCount(10, $result);
        $this->assertTrue($result->hasMorePages());
    }

    public function testSelect2()
    {
        Autor::factory()->create(['nome' => 'Test Autor']);

        $request = new \Illuminate\Http\Request(['q' => 'Test', 'page' => 1]);

        $result = $this->autorService->select2($request);

        $this->assertCount(1, $result['results']);
        $this->assertEquals('Test Autor', $result['results'][0]['text']);
        $this->assertFalse($result['pagination']['more']);
    }

    public function testStore()
    {
        $request = new \Illuminate\Http\Request(['nome' => 'New Autor']);

        $this->autorService->store($request);

        $this->assertDatabaseHas('autors', ['nome' => 'New Autor']);
    }

    public function testFind()
    {
        $autor = Autor::factory()->create();

        $result = $this->autorService->find($autor->id);

        $this->assertEquals($autor->id, $result->id);
    }

    public function testUpdate()
    {
        $autor = Autor::factory()->create(['nome' => 'Old Autor']);
        $request = new \Illuminate\Http\Request(['nome' => 'Updated Autor']);

        $this->autorService->update($request, $autor->id);

        $this->assertDatabaseHas('autors', ['nome' => 'Updated Autor']);
    }

    public function testDestroy()
    {
        $autor = Autor::factory()->create();

        $this->autorService->destroy($autor->id);

        $this->assertDatabaseMissing('autors', ['id' => $autor->id]);
    }
}