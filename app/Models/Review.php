<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'review';
        protected $primaryKey = 'reviewid';

        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function bookContent()
        {
            return $this->belongsTo('App\Models\BookContent');
        }

}
