@extends('layouts.app')

@section('content')

<h1 class="text"> Purchase History</h1>

@foreach($orders as $order)
  <div class="text"> 
    <p> Order: {{ $order-> orderid}} </p>
    <p> Time: {{ $order->orderdate }}</p>
    <p> Credit Card Information: </p>
      <div class="text"> 
        <p> OwnerName: {{ $order->getCreditCard($order->creditcardid)->ownername }}</p>
        <p> CardNumber: {{ $order->getCreditCard($order->creditcardid)->cardnumber }}</p>
        <p> SecurityCode: {{ $order->getCreditCard($order->creditcardid)->securitycode }}</p>
      </div>
    <p> Books Bought: </p>
    @foreach($order->getOrderInformation($order-> orderid) as $orderInformation)
      <div class="text">
        <p> Name: {{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->title}} </p>
        <p> Price Bought: {{ $orderInformation->pricebought }} </p>
        <p> Quantity: {{ $orderInformation->quantity }}</p>
        <p> Status: {{ $orderInformation->orderstatus }} </p>
        <img src="{{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->bookcover }}" width="200" >
      </div>
    @endforeach
    <p> ------------------------------------------------------------------- </p>
  </div>
@endforeach

@endsection