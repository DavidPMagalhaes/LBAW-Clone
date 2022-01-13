@extends('layouts.app')

@section('content')

<h1 class="text"> Payment Methods </h1>

@foreach($creditCards as $creditCard)
  <div class="text"> 
    <p> OwnerName: {{ $creditCard->ownername }}</p>
    <p> Card Number: {{ $creditCard->cardnumber }} </p>
    <p> Security Code: {{ $creditCard->securitycode }} </p>

    <div id = "remove">
      <form action="/user/{{$creditCard->userid}}/payment-methods/{{$creditCard->cardid}}/delete" method="POST">
        @method('delete')
        @csrf
        <div>
          <button type="submit" class="red-button">Remove</button>
        </div>
      </form>
    </div>	

    <a href="" class="button">Edit</a>
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach
<a href="/user/{{$userid}}/payment-methods/add" class="button">Add Payment Method</a>
@endsection