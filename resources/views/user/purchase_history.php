@extends('user.profile')

@section('action')

<div class="flex justify-center pt-20">
  <div class="text">
        @foreach($orders as $order)
        <p> {{ $order->orderid}}</p>
        @endforeach

  </div>
</div>
@endsection