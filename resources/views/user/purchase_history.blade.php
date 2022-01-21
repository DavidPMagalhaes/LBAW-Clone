@extends('layouts.app')

@section('content')

<div class="text"> 
  <h1>Purchase History</h1>
</div>

@foreach($orders as $order)
  <div class="order"> 
   <div> <p1 style="padding-top: 30px;"> Order date:  </p1><p style="padding-top: 30px;"> {{date('d-m-Y', strtotime($order->date))}}
</p></div>  

    <div><p1> OwnerName:  </p1> <p>{{ $order->getCreditCard($order->creditcardid)->ownername }}</p1></div> 
    <div><p1> 
      <div id = "remove">
      <form action="/user/{{ $order->userid }}/purchase-history/{{ $order->orderid }}/delete" method="POST">
        @method('delete')
        @csrf
        <div>
          <button type="submit" class="red-button">Cancel Order</button>
        </div>
      </form>
      </div>
    </p1> <br> </div> 
    <br>
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">

    <p1> Books Bought: </p1>
    <div class="cart-books">
      @foreach($order->getOrderInformation($order-> orderid) as $orderInformation)

      <article class="book" >
      
        <img src="{{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->bookcover }}" width="200" height="250" >
        <h2> {{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->title}} </h2>
        <p> Quantity: {{ $orderInformation->quantity }}</p>
        <p> Status: {{ $orderInformation->orderstatus }} </p>
        <a class="button" href="/api/books/viewBook/{{ $orderInformation->bookid }}/addReview"> Add Review </a>
      </article>
      @endforeach

    </div>

  </div>
  <br>

@endforeach

@endsection