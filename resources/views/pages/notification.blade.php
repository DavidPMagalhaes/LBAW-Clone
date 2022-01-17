@extends('layouts.app')

@section('content')

<h1 class="text"> Notifications </h1>

@foreach($notifications as $notification)
  <div class="text"> 
    @if ($notification->orderid != null)
    <p> {{ $notification->notificationmessage }} on ordered Book "{{ $notification->getBookContent($notification->getBookProduct($notification->bookid)->bookcontentid)->title }}"</p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <p> ------------------------------------------------------- </p>
    @else
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <p> ------------------------------------------------------- </p>
    @endif
  </div>
@endforeach

@endsection