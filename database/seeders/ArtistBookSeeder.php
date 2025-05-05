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
        $artists = Artist::factory()->count(5)->create();

        foreach ($artists as $artist) {
            Book::factory()->count(3)->create([
                'artist_id' => $artist->id,    
            ]);
        }
    }
}
