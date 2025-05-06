<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',     //poner todos los campos de la bdd menos el id
        'description',
        'barcode',
        'artist_id',
    ];
    
    public function artist()
{
    return $this->belongsTo(Artist::class);
}

    public function gender(){
        return $this->belongsToMany(Gender::class, 'gender_books'); //hacemos un belongsToMany para diferenciar que es una relacion n-n. Despues del class, ponemos el nombre de la tabla que junta gender y book, en este caso genderBook,cuando es una relacion nn siempre debe haber una tabla que junte esas dos tablas que quieres relacionar.
    }

}
