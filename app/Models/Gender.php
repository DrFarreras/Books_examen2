<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
    ];

    public function Book(){
        return $this->belongsToMany(Book::class, 'genderBook');
    }
}
