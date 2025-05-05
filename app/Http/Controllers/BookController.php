<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){

        $book=Book::with(['Gender', 'artist'])->get(); //le pedimos con el with que tenga un gender, pero con el has filtramos por el que tenga una gender asignado.
        
        $books=Book::with('artist')->get();
        return Inertia::render('Welcome',['genderBook'=>$book, 'books'=>$books]);
    }

    public function create(){
        return Inertia::render('BookForm');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'barcode' => 'required|string|max:255',
        ]);
        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'barcode' => $request->barcode,
            'artist_id' => 1,
        ]);
        $book->save();
        return to_route('book.index');
    }

    public function edit(Request $request){
        $book=Book::find($request->id);
        return Inertia::render('BookEdit',['book'=>$book]);
        // dd($book);
        // dd($request->id);
    }

    public function update(Request $request){
        $book=Book::find($request->id);
        $book->name=$request->name;
        $book->description=$request->description;
        $book->barcode=$request->barcode;
        $book->artist_id=$request->artist_id;

        $book->save();
        return to_route('book.index');

        // dd($request->id);
    }

    public function destroy(Request $request){
        $book=Book::find($request->id);
        $book->delete();

        return $book;   
    }

    public function show(Request $request){
        $book=Book::find($request->id);
        return Inertia::render('Book',['book'=>$book]);
    }
}
