@extends('layouts.app')

@section('content')


    <div class="cart-books">

        @foreach($users as $user)
            <article class="">
            <div>User Name</div>
            <div>{{$user->name}}</div>
            <div>User email</div>
            <div>{{$user->email}}</div>
            <h2><a class="button" href="/admin/users/{{$user->id}}">See details</a></h2>

            <br>
            <hr>
            </article>
		@endforeach


@endsection
