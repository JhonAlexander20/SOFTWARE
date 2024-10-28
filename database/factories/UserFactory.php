<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'), // Genera un DNI ficticio
            'ruc' => $this->faker->optional()->numerify('###########'), // Genera un RUC opcional
            'email' => $this->faker->unique()->safeEmail(),
            'correo' => $this->faker->optional()->safeEmail(), // Otro correo opcional
            'celular' => $this->faker->optional()->phoneNumber(), // Genera un número de celular opcional
            'rol' => $this->faker->randomElement(['admin', 'empresa', 'postulante', 'supervisor']), // Asigna un rol aleatorio
            'archivo_cv' => $this->faker->optional()->word() . '.pdf', // Genera un nombre de archivo de CV ficticio
            'password' => Hash::make('password'), // Contraseña por defecto
            'remember_token' => Str::random(10),
            'is_approved' => $this->faker->boolean(), // Estado de aprobación aleatorio
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(), // Establece la verificación de email por defecto
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
