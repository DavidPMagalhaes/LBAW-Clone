@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
        </div>
    </div>

    <div class="general-content">
    <div class="btn-group">
        <a class="button"  href=""> User Profile</a> 
        <a class="button"  href="{{ $user->id }}/edit"> Edit profile</a> 
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
                            <img src = {{ $user->profilePicture }} width="220" height="220">
                            <figcaption>{{ $user->name }} </figcaption>
                        </div>
                        <div class="space"></div>
                        <div class= "information">
                            <h1> Account Details: {{ $user->profilePicture }} </h1><hr>
                            <p2>Username:</p2> <p3>  {{ $user->name }} </p3><hr>
                            <p2>Email: </p2> <p3>  {{ $user->email }}</p3><hr>
                            <p2>Password: </p2> <p3>  {{ $user->password }}</p3><hr>
                            <p2>aa {{ $user->isAdmin }}</p2>
                        </div>


                   </div>
                   
                 
                   
            </div>
    </div>

@endsection
