@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text">Book Page</h1>
        </div>
    </div>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
    </script>

    <div class="float-right">
        <div>
                <form action="{{$book->bookid}}/WishlistController.php" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="red-button">Add to WishList</button>
                </form>
        </div>
    </div>   
    <br>
    <br>
    <br>

    <div class="flex justify-center pt-20">
        <div class="text">
            <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
						class="float-right" width="200" height="auto">
            <p>Name: {{ $book->bookContent()->get('title')[0]->title }} </p>
            <p>Price: {{ $book->price }}</p>
            <p>Edition: {{ $book->edition }}</p>
            <p>Book Type: {{ $book->booktype }}</p>
            <p>Stock: {{ $book->stock }}</p>
            <p>Publisher: {{ $book->publisher }}</p>
            <a class="button" href="/api/books/viewBook/{{$book->bookid}}/reviews"> Reviews </a>
        </div>
    </div>

    <div class="btn-group float-left">
        <div>
            <form action="{{$book->bookid}}/CartController.php" method="POST">
                @method('PUT')
                @csrf
                <div class="block">
                    <h6>quantity</h6>
                    <input 
                        type="text" 
                        class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                        name="quantity">
            <button type="submit" class="button">Add to Cart</button>
        </div>
           
        </div>        
    </div>


@endsection
