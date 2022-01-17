@extends('layouts.app')

@section('content')

<section id="listing-books">
  <br><br>
  <h3>Public Favorites</h3>
  <section id="books">

      @each('partials.book', $books->sortByDesc(function ($book) {
                    $bookContent = $book->bookid($book->bookcontentid);

                    return $bookContent->average;
                }), 'book')

  </section>

</section>

@endsection
