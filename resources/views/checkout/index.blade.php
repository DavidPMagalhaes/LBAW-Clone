@extends('layouts.app')
@section('content')

@foreach($errors as $error)
	<div class="col-12">
		<div class = "alert alert-danger">
			<i class="fa fa-times"></i>
			{{$error}}
		</div>
	</div>
@endforeach

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

<div> 
        <p>Credit Card(s): <p>
		@foreach($creditCard as $creditCard)
		<p>Name: {{$creditCard->ownername}}</p>
		<p>Number: {{$creditCard->cardnumber}}</p>
		<p>Security code: {{$creditCard->securitycode}}</p>
		<br>
		@endforeach
</div>        

<div id = "checkout">
        <form action="checkout/confirmed" method="POST">
            {{ csrf_field() }}
            {{ method_field('put') }}
			<label>Select card</label>
			<input 
			type="text" 
			class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
			name="cardNumber"
			style="width: 400px;">
            <button  type="submit" class="btn btn-primary">Confirm</button>
</form>
</div>

@endsection
