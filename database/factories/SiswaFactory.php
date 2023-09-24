<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'kelas_id' => $this->faker->numberBetween(1, 3),
            'jurusan_id' => $this->faker->numberBetween(1, 3),
            'username' => $this->faker->userName(),
            'password' => Hash::make($this->faker->password()),
        ];
    }
}
