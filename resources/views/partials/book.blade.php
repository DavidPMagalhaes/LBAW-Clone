<article class="book" data-id="{{ $book->bookid }}">
    <a href="/api/books/viewBook/{{ $book->bookid }}">
    <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
						class="float-right" width="300" height="330"> </a>

    

    <div id = "book information">

        <a href="/api/books/viewBook/{{ $book->bookid }}"><h2>{{  $book->bookContent()->get('title')[0]->title }}</h2></a>
        <p> Written by {{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}</p> 
        <br><p1>{{ $book->price }}€</p1>



    </div>
</article>
