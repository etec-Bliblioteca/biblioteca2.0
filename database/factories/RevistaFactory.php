<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RevistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'=> fake()->name(),
            'descricao' => fake()->paragraph(1),
            'tema' => fake()->name(),
            'quantidade' => fake()->randomNumber(1),
            'imagem' => "semImagem2.png",
            'edicao' => fake()->name(),
            'issn' => fake()->name(),
        ];
    }
}
