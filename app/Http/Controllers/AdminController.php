<?php

namespace App\Http\Controllers;

use App\Models\OrderInformation;
use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function users(){
        $users = User::all();
        if (Auth::user()->isadmin == 'True'){
            return view('admin.users')->with('users', $users);
        }
        else return redirect('/home');
    }

    public function userDetails($id){
        $user = User::find($id);
        $orders = UserOrder::where('userid', '=', $id)->get();

        return view('admin.user_details', ['orders' => $orders])->with('user', $user);
    }

    public function updateStatus(Request $request, $orderid, $bookid){
        $orderInformation = OrderInformation::where('orderid', '=', $orderid)
        ->where('bookid', '=', $bookid)   
        ->first();

        if($orderInformation) {
            $orderInformation->orderstatus = $request->input('orderstatus');
            $orderInformation->save();
        }
        return redirect('/home');

    }

}