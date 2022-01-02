@extends('layouts.app')
@section('content')
<div class="text"> 
    <h1>Checkout</h1>
    <h2>Order Details: </h2>

</div>



<div class="cart-books">
		@foreach($bookIds as $book)


		<article class="book" data-id="{{ $book->bookid }}">

			<div class="text">
				<a href="/api/books/viewBook/{{ $book->bookid }}">
					<img src="{{$book->bookContentid($book->bookid($book->bookid)->bookcontentid)->bookcover}}" 
						width="200" height="250" ></a>
						
				
				<h2><a href="/api/books/viewBook/{{ $book->bookid }}" > {{ $book->bookContentid($book->bookid($book->bookid)->bookcontentid)->title }}</a></h2>
				<p> {{ $book->bookid($book->bookid)->price }}€</p>
				<p1>Quantity: {{ $book->quantity }}</p1>

			</div>
		</article>
		@endforeach
</div>

<div class="text"> 
        <p2>Credit Card:     {{$creditCard->cardnumber}}</p2>    
</div>        
<div id = "checkout">
        <form action="checkout/confirmed" method="POST">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <a  type="submit" class="button">Confirm</button>
</div>

@endsection
