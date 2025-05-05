<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index(){
        $artists=Artist::all();
        return Inertia::render('Welcome',['artists'=>$artists]);
    }
}
