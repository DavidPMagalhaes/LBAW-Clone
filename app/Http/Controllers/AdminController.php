<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return view('admin.user_details')->with('user', $user);
    }

}