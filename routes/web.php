<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ArtistController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/books', [BookController::class, 'index'])->name('book.index');                     //Listar todos

Route::get('/booksForm', [BookController::class, 'create'])->name('book.create');               //Crear     //VAN A LA MISMA RUTA 
Route::post('/booksForm', [BookController::class, 'store'])->name('book.store');                //Guardar   //PARA GUARDAR LO CREADO

Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('book.edit');             //Editar
Route::post('/books/edit/{id}', [BookController::class, 'update'])->name('book.update');        //Guardar editado
Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])->name('book.delete');   //Borrar
Route::get('/book/{id}',[BookController::class, 'show'])->name('book.show');                    //Mostrar uno solo


require __DIR__.'/auth.php';
