@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
        </div>
    </div>

    <div class="general-content">
    <div class="btn-group">
        <a class="button"  href=""> User Profile</a> 
        <a class="button"  href="edit"> Edit profile</a> 
        <a class="button"  href=" {{ $user->id }}/payment-methods"> Payment methods</a> 
        <a class="button" href=" {{ $user->id }}/wishlist" > WishList </a>
        <a class="button" href=" {{ $user->id }}/review-history"> Review history </a> 
        <a class="button" href=" {{ $user->id }}/order-history"> Order history </a> 

    </div>
               <div class="block">
                   <!--@yield('action')-->
                   <h1> Profile</h1>
                   <div class= "profile-info">
                        <div class= "photo-name">
                            <img src= "https://media.istockphoto.com/photos/portrait-of-smiling-mixed-race-woman-looking-at-camera-picture-id1319763830?b=1&k=20&m=1319763830&s=170667a&w=0&h=wE44n9yP1nrefeqv5DCl5mE3ouU01FNNHeZPR0yDCWA=" width="220" height="220">
                            <figcaption>{{ $user->name }} </figcaption>
                        </div>
                        <div class="space"></div>
                        <div class= "information">
                            <h1> Account Details:</h1><hr>
                            <p2>Username:</p2> <p3> {{ $user->name }} </p3><hr>
                            <p2>Email: </p2> <p3>{{ $user->email }}</p3><hr>
                            <p2>Password: </p2> <p3>{{ $user->userpassword }}</p3><hr>
                        </div>


                   </div>
                   
                 
                   
            </div>
    </div>

@endsection
