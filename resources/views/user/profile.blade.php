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
        <a class="button"  href=" {{ $user ?? ''->id }}/payment-methods"> Payment methods</a> 
        <a class="button" href=" {{ $user ?? ''->id }}/review-history"> Review history </a> 
        <a class="button" href=" {{ $user ?? ''->id }}/purchase-history"> Order history </a> 

    </div>
               <div class="block">
                   @yield('action')
                   
                   
               </div>
                   
                   
                 
    </div>        

@endsection
