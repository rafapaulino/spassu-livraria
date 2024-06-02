<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->name(40),
            'preco' => fake()->randomFloat(2, 30, 200),
            'editora' => fake()->company(40),
            'edicao' => fake()->numberBetween(1, 8),
            'ano_publicacao' => fake()->year(),
        ];
    }
}
