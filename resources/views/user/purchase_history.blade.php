@extends('layouts.app')

@section('content')

<div class="text"> 
  <h1>Purchase History</h1>
</div>

@foreach($orders as $order)
  <div class="order"> 
   <div> <p1 style="padding-top: 30px;"> Order date:  </p1><p style="padding-top: 30px;">   {{ $order->orderdate }}</p></div>  

    <div><p1> OwnerName:  </p1> <p>{{ $order->getCreditCard($order->creditcardid)->ownername }}</p1></div> 

    <hr style="height:2px;border-width:0;color:gray;background-color:gray">

    <p1> Books Bought: </p1>
    <div class="cart-books">
      @foreach($order->getOrderInformation($order-> orderid) as $orderInformation)

      <article class="book" >
      
        <img src="{{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->bookcover }}" width="200" height="250" >
        <h2> {{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->title}} </h2>
        <p> Quantity: {{ $orderInformation->quantity }}</p>
        <p> Status: {{ $orderInformation->orderstatus }} </p>
      </article>
      @endforeach

    </div>

  </div>
  <br>

@endforeach

@endsection