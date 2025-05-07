<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        $allbooks=Book::with(['gender', 'artist'])->get(); //le pedimos con el with que tenga un campo gender. SE PILLA EL NOMBRE DE LA FUNCION DEL MODELO, SI NO LO PILLAS VES A MODELO TETE
        
        $book=Book::with(['gender', 'artist'])->paginate(4);

        //$books=Book::with('artist')->get(); //le pedimos que tenga una relacion con artist 'solo si solo tiene una relacion belongs_to con la tabla artist'
        return Inertia::render('Welcome',['genderBook'=>$book, 'allBooks'=>$allbooks]); //devuelve un render de la pagina welcome, donde pasa el parametro de vista 'genderBook' y 'artist' que asignamos que corresponde a la variable $book (en el caso de ser solo del belongs_to hacemos la variable de la vista 'artist' que corresponda a la variable $books)
    }

    public function create(){
        return Inertia::render('BookForm');     //le pedimos que renderice el formulario de 'BookForm'
    }

    public function store(Request $request){
        $request->validate([                    //hacemos validaciones del request
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'barcode' => 'required|string|max:255',
        ]);
        $book = Book::create([                  //una vez hechas las validaciones del request, se crean los datos a partir de la bdd con los inputs ('name' por ejemplo es en este caso el campo de la bdd y el $request->name es del input de la vista).
            'name' => $request->name,
            'description' => $request->description,
            'barcode' => $request->barcode,
            'artist_id' => 1,                   
        ]);
        $book->save();                          //hacemos un save de los datos
        return to_route('book.index');          //hacemos un return a book.index (book.index pertenece a la ruta name->('book.index) en web.php)
    }

    public function edit(Request $request){
        $book=Book::find($request->id);         //definimos que la variable $book sea igual al modelo Book y busque el id del request
        return Inertia::render('BookEdit',['book'=>$book]);     //devuelve un render del formulario de edicion BookEdit y le pasamos que los datos del 'book' es = a $book
        // dd($book);
        // dd($request->id);
    }

    public function update(Request $request){
        $book=Book::find($request->id);         //definimos que la variable $book sea igual al modelo Book y busque el id del request
        $book->name=$request->name;             //definimos que los datos de la vista name en $request->name es igual al campo name del modelo
        $book->description=$request->description; //definimos que los datos de la vista description en $request->description es igual al campo description del modelo
        $book->barcode=$request->barcode;       //definimos que los datos de la vista barcode en $request->barcode es igual al campo barcode del modelo
        $book->artist_id=$request->artist_id;   //definimos que los datos de la vista artist_id en $request->artist_id es igual al campo artist_id del modelo

        $book->save();                          //guardamos la variable $book con esos cambios
        return to_route('book.index');          //devolvemos a la ruta index book

        // dd($request->id);
    }

    public function destroy(Request $request){  
        $book=Book::find($request->id);         //definimos que la variable $book sea igual al modelo Book y busque el id del request
        $book->delete();                        //borramos la variable $book con esos datos

        return $book;                           //devolvemos la variable $book
    }

    public function show(Request $request){
        $book=Book::find($request->id);         //definimos que la variable $book sea igual al modelo Book y busque el id del request
        return Inertia::render('Book',['book'=>$book]); //devuelve un render del formulario de edicion Book y le pasamos que los datos del 'book' es = a $book
    }
}
