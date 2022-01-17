@extends('layouts.app')

@section('content')

<h1 class="text"> Notifications </h1>

@foreach($notifications as $notification)
  <div class="text"> 
    @if ($notification->orderid != null)
    <p> {{ $notification->notificationmessage }} on ordered Book "{{ $notification->getBookContent($notification->getBookProduct($notification->bookid)->bookcontentid)->title }}"</p>
    <p> Time: {{ $notification->notificationtime }} </p>
    @else
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ $notification->notificationtime }} </p>
    @endif
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection