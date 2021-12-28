<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'Author';
    protected $primaryKey = 'authorid';

    public function books()
    {
        return $this->hasMany('App\Models\BookContent');
    }

}
