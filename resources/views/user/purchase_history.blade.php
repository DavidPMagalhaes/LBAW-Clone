
@extends('user.profile')

@section('action')

<h1> Profile</h1>
  <div class="text">
  @foreach($orders as $order)
  <p>Edition: {{ $order->order_id }}</p>

  @endforeach

  </div>
@endsection