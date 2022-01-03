@extends('layouts.app')

@section('content')

<h1 class="text"> Reviews </h1>

@foreach($reviews as $review)
  <div class="text"> 
    <p> Comment: {{ $review->reviewcomment }}</p>
    <p> Rating: {{ $review->rating }} </p>
    <p> Time posted: {{ $review->timeposted }} </p>
    <p> ------------------------------------------------------- </p>
  </div>
@endforeach

@endsection