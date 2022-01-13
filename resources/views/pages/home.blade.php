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
  <ul>
    <li><a  href="/category/Romance"> Romance</a> </li>
    <li><a   href="/category/Comedy"> Comedy</a> </li>
    <li><a  href="/category/Biography"> Biography</a> </li>
    <li> <a  href="/category/Sport"> Sport</a> </li>
    <li><a  href="/category/Drama"> Drama </a> 
    <li><a href="/category/Sci-fi"> Sci-Fi </a> 
    <li><a href="/category/Western"> Western</a> </li>
    <li><a href="/category/War"> War</a> </li>
    <li><a href="/category/Adventure"> Adventure</a> </li>
    <li><a href="/category/Horror"> Horror </a> </li>
    <li><a href="/category/Fantasy"> Fantasy </a> </li>
    <li><a  href="/category/Mystery"> Mystery</a> </li>
    <li><a  href="/category/Crime"> Crime</a> </li>
    <li><a href="/category/Family"> Family</a> </li>
    <li><a href="/category/History"> History </a> </li>
  </ul>
  </div>


  <section id="content">

    @yield('information')

  </section>



</div>
 


@endsection
