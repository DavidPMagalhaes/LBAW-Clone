@extends('layouts.app')

@section('content')

<h1 class="text"> Reviews </h1>

@foreach($reviews as $review)
  <div class="text"> 
    <p> Comment: {{ $review->reviewcomment }}</p>
    <p> Rating: {{ $review->rating }} </p>
    <p> Time posted: {{ $review->timeposted }} </p>

    <div id = "remove">
      <form action="review-history/{{ $review->reviewid }}/delete" method="POST">
        @method('delete')
        @csrf
        <div>
          <button type="submit" class="red-button">Remove</button>
        </div>
      </form>
    </div>	
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection