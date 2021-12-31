@extends('layouts.app')

@section('content')


<section id="books">
      @each('partials.book', $books, 'book')
    </section>

@endsection
