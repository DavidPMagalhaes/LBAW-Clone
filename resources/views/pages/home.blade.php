@extends('layouts.app')

@section('title', 'Home')

@section('content')


<div id="content">

  <div class="btn-group">
    <a class="button"  href="category/Romance"> Romance</a> 
    <a class="button"  href="category/Comedy"> Comedy</a> 
    <a class="button"  href="category/Biography"> Biography</a> 
    <a class="button" href="category/Sport"> Sport</a> 
    <a class="button" href="category/Drama"> Drama </a> 
    <a class="button" href="category/Sci-fi"> Sci-Fi </a> 
    <a class="button"  href="category/Western"> Western</a> 
    <a class="button"  href="category/War"> War</a> 
    <a class="button" href="category/Adventure"> Adventure</a> 
    <a class="button" href="category/Horror"> Horror </a> 
    <a class="button" href="category/Fantasy"> Fantasy </a> 
    <a class="button"  href="category/Mystery"> Mystery</a> 
    <a class="button"  href="category/Crime"> Crime</a> 
    <a class="button" href="category/Family"> Family</a> 
    <a class="button" href="category/History"> History </a> 
  </div>


  <div id="listing-books">

    <h1 class="text">Novidades em Destaque</h1>
    <section id="books">
      @each('partials.book', $books, 'book')
    </section>
  </div>
  





</div>
 


@endsection
