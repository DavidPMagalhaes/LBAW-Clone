@extends('home.home')


@section('listingNormal')

<div id="listing-books">
    <div>
        <h1>New in
        <a type="button"class="btn btn-secondary" href="{{ url('/books-id') }}">See more</a></h1>
    </div>
    
    <section id="books">

    @foreach($books as $book)
    <article class="book" data-id="{{ $book->bookid }}">
        @if($loop->index == 6)
            @break
        @endif
        <a href="/api/books/viewBook/{{ $book->bookid }}">
        <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
        class="float-left" width="160" height="230"> </a>
        

        <a href="/api/books/viewBook/{{ $book->bookid }}"><h3>{{  $book->bookContent()->get('title')[0]->title }}</h3></a>
        
        <div id = "book-information">
            <p> Written by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> 
            <p1>{{ $book->price }}€</p1>
    

        </div>
    </article>
    @endforeach


    </section>
<br>

@yield('bestRated')

</div>


@endsection
