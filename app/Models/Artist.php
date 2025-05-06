<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;                             //usamos el factory.

    protected $fillable = ['name', 'surname'];  //hacemos un protected $fillable de los campos que va a tener la bdd

    public function books()
    {
        return $this->hasMany(Book::class);     //definimos que en la function books devuelve, artist define que tiene varios modelo Book
    }
}
