@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text">Book Page</h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <div class="block">
            <div>
                <h2 class="text">Price: {{ $book->price }}</h2>
            </div>
            <div>
                <h2 class="text">Stock: {{ $book->stock }}</h2>
            </div>
            <div>
                <h2 class="text">Publisher: {{ $book->publisher }}</h2>
            </div>
        </div>
    </div>

@endsection
