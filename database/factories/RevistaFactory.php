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
        $first = random_int(0,5000);
        $second = random_int(0,5000);
        return [
            'titulo'=> fake()->name(),
            'descricao' => fake()->paragraph(1),
            'tema' => fake()->name(),
            'quantidade' => random_int(0,100),
            'imagem' => "semImagem.jpg",
            'edicao' => fake()->name(),
            'issn' => "$first - $second" . "X"
        ];
    }
}
