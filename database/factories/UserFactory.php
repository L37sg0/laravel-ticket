<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User as Model;

class UserFactory extends Factory
{
    protected $model = Model::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Model::FIELD_NAME               => fake()->name(),
            Model::FIELD_EMAIL              => fake()->unique()->safeEmail(),
            Model::FIELD_EMAIL_VERIFIED_AT  => now(),
            Model::FIELD_PASSWORD           => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            Model::FIELD_REMEMBER_TOKEN     => Str::random(10),
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
