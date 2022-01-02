@extends('pages.home')

@section('title', 'category')


@section('information')


<section id="books">
      @each('partials.book', $books, 'book')
    </section>

@endsection
