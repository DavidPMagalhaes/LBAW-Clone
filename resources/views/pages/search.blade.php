@extends('layouts.app')

@section('content')

<div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text">Novidades em Destaque</h1>
        </div>
</div>

<div class="flex justify-center pt-20">
  <div class="text">
        @foreach($books as $book)
      <div class="flex justify-center pt-20">
        <div class="text">
          <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
						class="float-right" width="200" height="flex">
          <p>Name: {{  $book->bookContent()->get('title')[0]->title }} </p>
          <p>Price: {{ $book->price }}</p>
          <p>Edition: {{ $book->edition }}</p>
          <p>Book Type: {{ $book->booktype }}</p>
          <p>Stock: {{ $book->stock }}</p>
          <p>Publisher: {{ $book->publisher }}</p>
          

          <a class="button" href='/api/books/viewBook/{{ $book->bookid }}'> View Details</a>
        </div>
      </div>
      <hr style="width:50%;text-align:left;margin-left:0">

      @endforeach
  </div>
</div>

@endsection
