@extends('layouts.app')

@section('title', 'Home')

@section('content')


<div id="content">

  <div class="btn-group">
  <a class="button"  href=""> Non-Fiction</a> 
        <a class="button"  href="edit"> Adventure</a> 
        <a class="button"  href=""> Fantasy</a> 
        <a class="button" href=" "> Crime</a> 
        <a class="button" href=""> Romance </a> 




  </div>


  <div id="listing-books">

    <h1 class="text">Novidades em Destaque</h1>
    <section id="books">
      @each('partials.book', $books, 'book')
    </section>
  </div>
  





</div>
 


@endsection
