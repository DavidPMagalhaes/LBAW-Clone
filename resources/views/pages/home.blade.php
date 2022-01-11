@extends('layouts.app')

@section('title', 'Home')

@section('content')

@if (Auth::check())
  @if (Auth::user()->isadmin == 'True')
    <a class="button" href="/api/books/addBook"> Add Book </a>
  @endif
@endif


<div id="content">

  <div class="btn-group">
    <a class="button"  href="/category/Romance"> Romance</a> 
    <a class="button"  href="/category/Comedy"> Comedy</a> 
    <a class="button"  href="/category/Biography"> Biography</a> 
    <a class="button" href="/category/Sport"> Sport</a> 
    <a class="button" href="/category/Drama"> Drama </a> 
    <a class="button" href="/category/Sci-fi"> Sci-Fi </a> 
    <a class="button"  href="/category/Western"> Western</a> 
    <a class="button"  href="/category/War"> War</a> 
    <a class="button" href="/category/Adventure"> Adventure</a> 
    <a class="button" href="/category/Horror"> Horror </a> 
    <a class="button" href="/category/Fantasy"> Fantasy </a> 
    <a class="button"  href="/category/Mystery"> Mystery</a> 
    <a class="button"  href="/category/Crime"> Crime</a> 
    <a class="button" href="/category/Family"> Family</a> 
    <a class="button" href="/category/History"> History </a> 
  </div>


  <section id="content">

    @yield('information')

  </section>



</div>
 


@endsection
