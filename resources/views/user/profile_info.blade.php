@extends('user.profile')


@section('action')

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
        </div>


    </div>

@endsection