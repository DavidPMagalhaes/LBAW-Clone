<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookProduct extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'book_product';
    protected $primaryKey = 'bookid';

    public function bookContent() {
        return $this->hasOne('App\Models\BookContent');
    }

    public function carts()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function wishlists()
    {
        return $this->belongsTo('App\Models\Wishlist');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\OrderInformation');
    }

}
