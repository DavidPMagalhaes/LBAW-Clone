<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInformation extends Model
{
    use HasFactory;


        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'order_information';

        protected $fillable = [
            'orderid', 'bookid', 'priceBought','orderStatus', 'quantity'
        ];


        public function notifications()
        {
            return $this->hasMany('App\Models\Notification');
        }

        public function creditCard()
        {
            return $this->belongsTo('App\Models\UserOrder');
        }

        public function books()
        {
            return $this->hasMany('App\Models\BookProduct', 'bookid');
        }

        public function userOrder()
        {
            return $this->hasOne('App\Models\UserOrder', 'orderid');
        }


}
