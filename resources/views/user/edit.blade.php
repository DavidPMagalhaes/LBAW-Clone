@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">User Profile</h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/user/1" method="POST">
            @method('PUT')
            @csrf
            <div class="block">
                <h6>name</h6>
                <input 
                    type="text" 
                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                    name="name"
                    value="{{ $user->name }}">
                <h6>email</h6>
                <input 
                    type="text" 
                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                    name="email"
                    value="{{ $user->email }}">
                <h6>password</h6>
                <input 
                    type="text" 
                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                    name="password"
                    value="{{ $user->userpassword }}">
                <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-">
                    Save
                </button>




            </div>
        </form>
    </div>

@endsection


