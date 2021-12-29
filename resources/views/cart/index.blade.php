@extends('layouts.app')

@section('content')
	<div class="m-auto w-4/8 py-24">
		<div class="text-center">
			<h1 class="text-5xl uppercase bold">Cart</h1>
		</div>
	</div>
	<a class="button float-right" href="logout">checkout</a>
	<div class="w-5/6 py-10">
		@foreach($bookIds as $book)
		<div class="flex justify-center pt-20">
			<div class="text">
				<p>id: {{ $book->bookid }}</p>
				<p>Name: {{$book->books()->get('bookcontentid')->get('title') }}</p>
				<p>Price: {{ $book->books()->get('price') }}</p>
				<p>Stock: {{ $book->books()->get('stock')}}</p>
				<p>Publisher: {{ $book->books()->get('publisher') }}</p>
				<p>Quantity: {{ $book->quantity }}</p>
			</div>
		</div>
		<hr style="width:50%;text-align:left;margin-left:0">

		@endforeach
	</div>


@endsection
