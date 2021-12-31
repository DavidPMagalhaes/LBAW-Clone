<article class="book" data-id="{{ $book->bookid }}">
    <a href="api/books/viewBook/{{ $book->bookid }}">
    <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
						class="float-right" width="300" height="350"> </a>

    
          <!--<p>Name: {{  $book->bookContent()->get('title')[0]->title }} </p>
          <p>Price: {{ $book->price }}</p>
          <p>Edition: {{ $book->edition }}</p>
          <p>Book Type: {{ $book->booktype }}</p>
          <p>Stock: {{ $book->stock }}</p>
          <p>Publisher: {{ $book->publisher }}</p>-->
    <div id = "book information">

        <h2><a href="api/books/viewBook/{{ $book->bookid }}">{{  $book->bookContent()->get('title')[0]->title }}</a></h2>
        <p> Written by $book->bookContent()->get('authorid')[0]->authorid</p> 
        <p1>{{ $book->price }}€</p1>



    </div>
</article>
