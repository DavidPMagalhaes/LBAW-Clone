<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT * from user
        //$data = 
        return view('user/profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisteredUser  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        //dd($user);
        return view('user.profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegisteredUser  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password')
        ]);
        //n sei se é assim para aceder ao valor de id
        $user->save();

        return redirect('/user/{{Auth::user()->id}}');

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisteredUser  $registeredUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }
}
