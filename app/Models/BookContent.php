<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookContent extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'book_content';
    protected $primaryKey = 'bookid';

    public function bookProduct() {
        return $this->belongsTo('App\Models\BookProduct', 'bookcontentid');
    }
}
