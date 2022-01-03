@extends('pages.home')

@section('title', 'Books')

@section('information')

    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
    </script>
 

    <div id = "bookpage">


            <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
                width="400" height="500"> </a>

            <div class="text">

                <div>
                    <h1> {{ $book->bookContent()->get('title')[0]->title }} </h1>
                    <p> Written by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> 
                    <p>Edition: {{ $book->edition }}</p>
                    <p>Book Type: {{ $book->booktype }}</p>
                    <p>Publisher: {{ $book->publisher }}</p>
                    <a class="button" href="/api/books/viewBook/{{$book->bookid}}/reviews"> Reviews </a>
                    <a class="button" href="/api/books/viewBook/{{$book->bookid}}/addReview"> Add Review </a>
                    @if (Auth::user()->isadmin == 'True')
                        <a class="button" href="/api/books/viewBook/{{$book->bookid}}/edit"> Edit Book </a>
                    @endif

                </div>

                
                <div id ="price-buttons">
                    <h2>{{ $book->price }}€</h2>

                    <div>
                        <form action="{{$book->bookid}}/CartController.php" method="POST">
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
                            <form action="{{$book->bookid}}/WishlistController.php" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="red-button">Add to WishList</button>
                            </form>
                    </div>



                </div>
            </div>



    </div>

   




@endsection
