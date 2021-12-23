@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section id="home">
  <div2>
  <a class="button" href="{{ url('/logout') }}"> Contact us </a> 
  <a class="button" href="{{ url('/logout') }}"> FAQ </a> 
  <a class="button" href="{{ url('/logout') }}"> Services </a> 
  </div2>
  @each('partials.card', $cards, 'card')
  <article class="card">
    <form class="new_card">
      <input type="text" name="name" placeholder="new card">
    </form>
  </article>
</section>

@endsection
