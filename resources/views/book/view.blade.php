@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text">Book Page</h1>
        </div>
    </div>

    <div class="btn-group float-right">
        <div>
            <h6>quantity</h6> 
            <input 
                type="text" 
                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                name="quantity">
            <a class="button"  href=""> Add to Cart</a> 
        </div>
        
        <a class="button"  href=""> Add to Wishlist</a> 
    </div>

    <div class="flex justify-center pt-20">
        <div class="text">
        <p>Name: {{ $book->title }} </p>
          <p>Price: {{ $book->price }}</p>
          <p>Edition: {{ $book->edition }}</p>
          <p>Book Type: {{ $book->booktype }}</p>
          <p>Stock: {{ $book->stock }}</p>
          <p>Publisher: {{ $book->publisher }}</p>
        </div>
    </div>

@endsection
