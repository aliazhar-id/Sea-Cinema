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
    $username =  str_replace(".", "-", fake()->unique()->userName());

    return [
      'name' => fake()->name(),
      'username' => $username,
      'password' => static::$password ??= Hash::make('123'),
      'email' => fake()->unique()->freeEmail(),
      'dob' => fake()->dateTimeBetween('1990-01-01', '2015-12-31')->format('Y/m/d'),
      'address' => fake()->address(),
      'phone' => fake()->phoneNumber(),
      'remember_token' => Str::random(10),
      'image' => fake()->imageUrl(360, 360, 'animals', true, 'cats'),
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
