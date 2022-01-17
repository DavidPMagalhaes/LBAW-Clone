@extends('layouts.app')

@section('content')

<h1 class="text"> Notifications </h1>

@foreach($notifications as $notification)
  <div class="text"> 
    @if ($notification->orderid != null)
    <p> {{ $notification->notificationmessage }} on ordered Book "{{ $notification->getBookContent($notification->getBookProduct($notification->bookid)->bookcontentid)->title }}"</p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <a class="btn btn-primary"href=" /user/{{ $notification->userid }}/purchase-history"> View Order </a> 

    @else
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <a class="btn btn-primary" href=" /user/{{ $notification->userid }}/payment-methods"> View Payment Methods </a> 
    @endif
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection