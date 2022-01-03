@extends('layouts.app')

@section('content')

<h1 class="text"> Reviews </h1>

<p class="text"> AVERAGE RATING: {{ $book->average }}</p>

@foreach($reviews as $review)
  <div class="text"> 
    <p> Comment: {{ $review->reviewcomment }}</p>
    <p> Rating: {{ $review->rating }} </p>
    <p> Time posted: {{ $review->timeposted }} </p>
    <p> By User: {{ $review->getUser($review->userid)->name }} </p>
    @if (Auth::check() && $review->userid === Auth::id())
    <div id = "remove">
      <form action="/user/{{ $review->userid }}/review-history/{{ $review->reviewid }}/delete" method="POST">
        @method('delete')
        @csrf
        <div>
          <button type="submit" class="red-button">Remove</button>
        </div>
      </form>
    </div>	

    <a href="/user/{{ $review->userid }}/review-history/{{ $review->reviewid }}/edit" class="button">Editar</a>

    @endif
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection