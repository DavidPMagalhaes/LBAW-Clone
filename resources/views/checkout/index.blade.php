@extends('layouts.app')
int $randomNum = rand(100000,999999);
@section('content')
<h1 class=""> Checkout</h1>
<h2> Order Details </h2>
    @foreach($bookIds as $book)
        <div class="">
            <div class="text-center">
                <h3> Book: </h3>
                <img src="{{$book->bookContentid($book->bookid($book->bookid)->bookcontentid)->bookcover}}" 
						class="float-right" width="100" height="auto">
                <p>Price: {{ $book->bookid($book->bookid)->price }}</p>
                <br>
                <p>Quantity: {{$book->quantity}}</p>
            </div>
        </div>
        @endforeach
    <h3>Credit Card: {{$creditCard->cardnumber}}</h3>            
    <div class="float-left">
        <form action="" method="POST">
            @method('put')
            @csrf
            <div>
                <button type="submit" class="button">Confirm</button>
            </div>
        </form>
    </div>

@endsection
