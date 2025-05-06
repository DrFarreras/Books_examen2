<?php

namespace Database\Factories;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),                                     //hacemos un faker y definimos que el campo de la bdd 'name' es un faker que usa el método word
            'description' => $this->faker->sentence(),                          //hacemos un faker y definimos que el campo de la bdd 'description' es un faker que usa el método sentence
            'barcode' => $this->faker->numberBetween(10000,99999),              //hacemos un faker y definimos que el campo de la bdd 'barcode' es un faker que usa el método numberBetween(10000,99999)
            'artist_id' => \App\Models\Artist::inRandomOrder()->first()->id,    //hacemos un faker y definimos que el campo de la bdd 'artist_id' es un faker que usa el método inRandomOrder()->first()->id
        ];
    }
}
