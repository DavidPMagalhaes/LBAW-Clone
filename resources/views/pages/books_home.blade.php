@extends('pages.home')

@section('title', 'Books')

@section('information')


<div id="listing-books">

<h1 class="text">New in</h1>
<section id="books">
  @each('partials.book', $books, 'book')
</section>
</div>

@endsection
