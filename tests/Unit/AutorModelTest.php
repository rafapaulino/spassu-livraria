<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutorModelTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_autor_create(): void
    {
        $autor = Autor::factory()->create([
            'nome' => 'Teste'
        ]);

        $this->assertDatabaseHas('autors', [
            'nome' => 'Teste'
        ]);
    }

    public function test_autor_equal(): void
    {
        $autor = new Autor([
            'nome' => 'Novo'
        ]);

        $this->assertEquals('Novo', $autor->nome);
    }

    public function test_autor_not_set(): void
    {
        $autor = new Autor([
            'nome' => 'Autor',
            'attr' => 'Yes'
        ]);

        $this->assertArrayNotHasKey('attr', $autor->getAttributes());
    }

    public function test_autor_update(): void
    {
        $autor = Autor::factory()->create();
        $autor->nome = "Atualizado";
        $autor->save();

        $this->assertEquals('Atualizado', $autor->nome);
    }

    public function test_autor_deleted(): void
    {
        $autor = Autor::factory()->create();
        $autor->delete();

        $this->assertModelMissing($autor);
    }
}
