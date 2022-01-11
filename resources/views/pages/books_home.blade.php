@extends('pages.home')

@section('title', 'Books')

@section('information')


<div id="listing-books">

<div class="text">
  <h1 style="padding-left: 300px; padding-bottom : 0px;">New in</h1>
</div>

<section id="books">
  @each('partials.book', $books, 'book')
</section>
</div>

@endsection
