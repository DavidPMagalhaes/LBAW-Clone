<article class="book" data-id="{{ $book->bookid }}">
    <a href="/api/books/viewBook/{{ $book->bookid }}">
    <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
						class="float-right" width="300" height="350"> </a>

    

    <div id = "book information">

        <h2><a href="/api/books/viewBook/{{ $book->bookid }}">{{  $book->bookContent()->get('title')[0]->title }}</a></h2>
        <p> Written by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> 
        <p1>{{ $book->price }}€</p1>



    </div>
</article>
