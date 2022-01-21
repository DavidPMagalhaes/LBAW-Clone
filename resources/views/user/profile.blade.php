@extends('layouts.app')



@section('content')
<br><br><br>
 
    <div class="general-content">
        <div class="btn-group-vertical">
            <a class="btn btn-primary" href="/user/{{$user->id}}"> User Profile</a> 
            <a class="btn btn-primary" href="/user/{{$user->id}}/edit"> Edit profile</a> 
            <a class="btn btn-primary" href=" {{ $user->id }}/payment-methods"> Payment methods</a> 
            <a class="btn btn-primary"href=" {{ $user->id }}/review-history"> Review history </a> 
            <a class="btn btn-primary"href=" /user/{{ $user->id }}/purchase-history"> Order history </a> 
            <a class="btn btn-primary"href=" /user/{{ $user->id }}/confirm-delete"> Delete account </a> 

        </div>
        <div class="block">   
            @yield('action')        
    </div>
    </div>
                   
                         

@endsection
