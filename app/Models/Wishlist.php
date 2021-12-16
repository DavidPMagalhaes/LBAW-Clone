<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'wishlist';
        //protected $primaryKey = 'reportid';
        //primary key composta...

}
