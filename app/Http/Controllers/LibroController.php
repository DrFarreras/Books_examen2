<?php

namespace App\Http\Controllers;
use App\Models\Libro;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroController extends Controller
{
    public function index(){
        $libros = Libro::all();
        return Inertia::render('Index', ['libros' => $libros]);
    }
}
