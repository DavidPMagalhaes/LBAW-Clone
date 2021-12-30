@extends('layouts.app')

@section('title', 'Home')

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
          <p>Name: {{  $book->bookid($book->bookid) }} </p>
          <p>Price: {{ $book->price }}</p>
          <p>Edition: {{ $book->edition }}</p>
          <p>Book Type: {{ $book->booktype }}</p>
          <p>Stock: {{ $book->stock }}</p>
          <p>Publisher: {{ $book->publisher }}</p>
          <p>Publisher: {{ $book->bookContent()->get('bookcover')}}</p>
          $bookcover= {{ $book->bookContent()->get('bookcover')}};
          <img src= $bookcover width="30" height="50"> 


          <a class="button" href='/api/books/viewBook/{{ $book->bookid }}'> View Details</a>
        </div>
      </div>
      <hr style="width:50%;text-align:left;margin-left:0">

      @endforeach
  </div>
</div>

@endsection
