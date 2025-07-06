<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamento>
 */
class AgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rm' => 1,
            'id_revista' => 1,
            'dt_pegar' => fake()->date(),
            'dt_devolver' => fake()->date(),
            'state' => false,
        ];
    }
}
