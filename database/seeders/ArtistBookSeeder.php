<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Book;

class ArtistBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = Artist::factory()->count(5)->create();       //hacemos un seeder que define que la variable $artists es = al modelo Artist que usa un factory y crea 5 artistas

        foreach ($artists as $artist) {                         //definimos que por cada $artists que sea $artist
            Book::factory()->count(3)->create([                 //del modelo Book que usa un factory crea 3 libros
                'artist_id' => $artist->id,                     //definimos que artist_id = a la variable $artist->id
            ]);
        }
    }
}
