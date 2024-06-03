<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssuntoModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_assunto_create(): void
    {
        Assunto::factory()->create([
            'descricao' => 'Teste'
        ]);

        $this->assertDatabaseHas('assuntos', [
            'descricao' => 'Teste'
        ]);
    }

    public function test_assunto_equal(): void
    {
        $assunto = new Assunto([
            'descricao' => 'Novo'
        ]);

        $this->assertEquals('Novo', $assunto->descricao);
    }

    public function test_assunto_not_set(): void
    {
        $assunto = new Assunto([
            'descricao' => 'Assunto',
            'attr' => 'Yes'
        ]);

        $this->assertArrayNotHasKey('attr', $assunto->getAttributes());
    }

    public function test_assunto_update(): void
    {
        $assunto = Assunto::factory()->create();
        $assunto->descricao = "Atualizado";
        $assunto->save();

        $this->assertEquals('Atualizado', $assunto->descricao);
    }

    public function test_assunto_deleted(): void
    {
        $assunto = Assunto::factory()->create();
        $assunto->delete();

        $this->assertModelMissing($assunto);
    }
}
