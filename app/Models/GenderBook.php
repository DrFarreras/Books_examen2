<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenderBook extends Model
{
    protected $fillable = [
        'book_id',
        'gender_id',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
}
