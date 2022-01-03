@extends('layouts.app')

@section('content')

<h1 class="text"> Notifications </h1>

@foreach($notifications as $notification)
  <div class="text"> 
    <p> {{ $notification->notificationmessage }} on ordered Book "{{ $notification->getBookContent($notification->getBookProduct($notification->bookid)->bookcontentid)->title }}"</p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection