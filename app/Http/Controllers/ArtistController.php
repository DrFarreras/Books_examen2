<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index(){           
        $artists=Artist::all();     //definimos que la variable $artists es = al modelo Artist y mostramos todo con un select * from artist con eloquent
        return Inertia::render('Welcome',['artists'=>$artists]);    //devuelve un render de la vista 'Welcome' y le pasamos que los datos del 'artists' es = a $artists
    }   
}
