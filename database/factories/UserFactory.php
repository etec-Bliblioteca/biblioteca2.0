<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rm'=> 000001,
            'nivel' => 1,
            'state' => 'ativo',
            'name' => "admin",
            'turma' => "test turma",
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'telefone' => 11949335503, //TOCAR DEPOIS EIN
        ];
    }
}
