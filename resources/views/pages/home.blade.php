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
          <p>Name: {{ $book->title }} </p>
          <p>Price: {{ $book->price }}</p>
          <p>Edition: {{ $book->edition }}</p>
          <p>Book Type: {{ $book->booktype }}</p>
          <p>Stock: {{ $book->stock }}</p>
          <p>Publisher: {{ $book->publisher }}</p>
        </div>
      </div>
      <hr style="width:50%;text-align:left;margin-left:0">

      @endforeach
  </div>
</div>

@endsection
