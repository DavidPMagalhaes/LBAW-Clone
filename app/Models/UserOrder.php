<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

        // Don't add create and update timestamps in database.
        public $timestamps  = false;

        protected $table = 'user_order';
        protected $primaryKey = 'orderid';

        protected $fillable = [
            'orderid', 'orderdate', 'creditcardid','userid'
        ];

        public function user()
        {
            return $this->belongsTo('App\Models\User');
        }

        public function creditCard()
        {
            return $this->belongsTo('App\Models\CreditCard');
        }

        //ao contrario?
        public function orderInformation()
        {
            return $this->belongsTo('App\Models\OrderInformation');
        }

}
