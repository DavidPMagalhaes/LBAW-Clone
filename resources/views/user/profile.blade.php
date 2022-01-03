@extends('layouts.app')




@section('content')
 
    <div class="general-content">
    <div class="btn-group">
        <a class="button"  href="/user/{{$user->id}}"> User Profile</a> 
        <a class="button"  href="/user/{{$user->id}}/edit"> Edit profile</a> 
        <a class="button"  href=" {{ $user ?? ''->id }}/payment-methods"> Payment methods</a> 
        <a class="button" href=" {{ $user ?? ''->id }}/review-history"> Review history </a> 
        <a class="button" href=" /user/{{ $user->id }}/purchase-history"> Order history </a> 

    </div>
               <div class="block">
                   @yield('action')
                   
                   
               </div>
                   
                   
                 
    </div>        

@endsection
