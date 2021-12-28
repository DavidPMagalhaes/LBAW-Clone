@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text">Book Page</h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <div class="text">
            <p>Price: {{ $book->price }}</p>
            <p>Stock: {{ $book->stock }}</p>
            <p>Publisher: {{ $book->publisher }}</p>
        </div>
    </div>

@endsection
