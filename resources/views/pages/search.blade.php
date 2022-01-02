@extends('pages.home')

@section('information')


<section id="books">
      @each('partials.book', $books, 'book')
    </section>

@endsection
