@extends('layouts.app')

@section('content')

<section id="listing-books">
  <br><br>
  <h1>See all</h1>
  <section id="books">

      @each('partials.book', $books, 'book')

  </section>

</section>

@endsection
