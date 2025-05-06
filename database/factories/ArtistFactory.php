<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),        //hacemos un faker y definimos que el campo de la bdd 'name' es un faker que usa el método firstName
            'surname' => $this->faker->lastName(),      //hacemos un faker y definimos que el campo de la bdd 'surname' es un faker que usa el método lastName
        ];
    }
}
