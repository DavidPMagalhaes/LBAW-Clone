<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'carts';

        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function books()
        {
            return $this->hasMany('App\Models\BookProduct');
        }
}
