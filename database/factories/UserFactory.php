<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastName,
            'cedula' => $this->faker->numerify('############'),
            'pais' => $this->faker->randomElement(['Argentina','Brazil','Chile','Colombia','Ecuador','Paraguay']),
            'direccion' => $this->faker->address,
            'celular'=> $this->faker->numerify('##########'),
            'categoria_id' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
