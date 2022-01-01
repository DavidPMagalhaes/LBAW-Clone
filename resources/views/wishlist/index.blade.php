@extends('layouts.app')

@section('content')
	<div class="m-auto w-4/8 py-24">
		<div class="text-center">
			<h1 class="text-5xl uppercase bold">Wishlist</h1>
		</div>
	</div>
	<div class="w-5/6 py-10">
		@foreach($bookIds as $book)
            <br>
            <br>
			<div class="float-right">
				<form action="wishlist/{{ $book->bookid }}/delete" method="POST">
					@method('delete')
					@csrf
					<div>
						<button type="submit" class="button">Remove</button>
					</div>
				</form>
			</div>	
			<br>
			<br>
			<div class="flex justify-center pt-20">
				<div class="text">
					<img src="{{$book->bookContentid($book->bookid($book->bookid)->bookcontentid)->bookcover}}" 
						class="float-right" width="200" height="auto">
					<p>id: {{ $book->bookid }}</p>
					
					<p>Name: {{ $book->bookContentid($book->bookid($book->bookid)->bookcontentid)->title }}</p>
					<p>Price: {{ $book->bookid($book->bookid)->price }}</p>
					<p>Stock: {{ $book->bookid($book->bookid)->stock}}</p>
					<p>Publisher: {{ $book->bookid($book->bookid)->publisher }}</p>
				</div>
			</div>
			<hr style="width:50%;text-align:left;margin-left:0">

		@endforeach
	</div>


@endsection
