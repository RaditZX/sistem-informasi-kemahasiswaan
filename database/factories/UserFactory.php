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
            'nama_depan' => fake()->name(),
            'nama_belakang' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'jenis_kelamin' => fake()->randomElement(['Pria', 'Wanita']) // Use randomElement to select from an array
        ];
    }


}
