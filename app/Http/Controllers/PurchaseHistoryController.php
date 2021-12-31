<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOrder;
use App\Models\OrderInformation;


use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $orders = UserOrder::where('userid', $id)->get();
        return view('user.purchase_history', ['orders' => $orders]);
    }
}
