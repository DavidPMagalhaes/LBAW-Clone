@extends('layouts.app')


@section('content')

    <!--<script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
    </script>-->
 

    <div id = "bookpage">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
            width="400" height="500"> 

        <div class="text">

            <h1> {{ $book->bookContent()->get('title')[0]->title }} 
            <p style=" padding-left:10px;">  by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> </h1>
            <p>Edition: {{ $book->edition }}</p>
            <p>Book Type: {{ $book->booktype }}</p>
            <p>Publisher: {{ $book->publisher }}</p>
            <div style="font-size: 50px; padding-left:30px; padding-top: 5px;">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star"></span>
            </div>
            <h2 style="padding-bottom:0px ;">Synopsis</h2>
            <p> {{$book->bookContent()->get('description')[0]->description}}</p>


            <a class="button" href="/api/books/viewBook/{{$book->bookid}}/reviews"> Reviews </a>
            <a class="button" href="/api/books/viewBook/{{$book->bookid}}/addReview"> Add Review </a>
            @if (Auth::check())
                @if (Auth::user()->isadmin == 'True')
                    <a class="button" href="/api/books/viewBook/{{$book->bookid}}/edit"> Edit Book </a>
                @endif
            @endif
            


            
        </div>
        <div id ="price-buttons">
                <h2>{{ $book->price }}€</h2>

                <div>
                    <form action="{{$book->bookid}}/add-to-cart" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="block">
                            <input 
                                type="number" value = 1 min=1
                                name="quantity">
                    <button type="submit" class="button">Add to Cart</button>
                </div>
                    </form>

                <div id="wish">
                        <form action="{{$book->bookid}}/add-to-wishlist" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="red-button">Add to WishList</button>
                        </form>
                </div>



            </div>


        </div>

    </div>



    <div id = "reviews">
         @yield('reviews');
    </div>
    

   




@endsection
