<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOrder;


use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $orders = User::with('orders')->find($id)->orders;
        $orders = UserOrder::where('orderid','=',$id)->get();
        return view('user.purchase_history')->with('orders', $orders);
    }
}
