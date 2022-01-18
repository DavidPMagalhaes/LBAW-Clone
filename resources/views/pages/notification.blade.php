@extends('layouts.app')

@section('content')

<h1 class="text"> Notifications </h1>

@foreach($notifications as $notification)
  <div class="text"> 
    @if ($notification->orderid != null)
    <p> {{ $notification->notificationmessage }} on ordered Book "{{ $notification->getBookContent($notification->getBookProduct($notification->bookid)->bookcontentid)->title }}"</p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <a class="btn btn-primary"href=" /user/{{ $notification->userid }}/purchase-history"> View Order </a> 
    @endif
    
    @if ($notification->creditcardid != null)
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <a class="btn btn-primary" href=" /user/{{ $notification->userid }}/payment-methods"> View Payment Methods </a> 
    @endif

    @if ($notification->creditcardid == null && $notification->orderid == null)
    <p> {{ $notification->notificationmessage }} </p>
    <p> Time: {{ $notification->notificationtime }} </p>
    <a class="btn btn-primary" href=" /api/books/viewBook/{{ $notification->bookid }}"> View Book </a> 
    @endif
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection