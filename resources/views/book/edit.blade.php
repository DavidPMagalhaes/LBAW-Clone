@extends('pages.home')

@section('title', 'Books')

@section('information')

    <div id = "bookpage">


            <img src="{{$book->bookContent()->get('bookcover')[0]->bookcover}}" 
                width="400" height="500"> </a>

            <div class="text">

                <div>
                    <form action="/api/books/viewBook/{{$book->bookid}}/edit/update" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div id="edit-formula">
                            <h6>Title</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="title"
                                value="{{ $book->bookContent()->get('title')[0]->title }}" style="width: 400px;">
                            
                            <h6>Author</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="author"
                                value="{{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}" style="width: 400px;">

                            <h6>Price</h6>
                                <input 
                                    type="text" 
                                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                    name="price"
                                    value="{{ $book->price }}" style="width: 400px;">

                            <h6>Stock</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="stock"
                                value="{{ $book->stock }}" style="width: 400px;">

                            <h6>Publisher</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="publisher"
                                value="{{ $book->publisher }}" style="width: 400px;">

                            <h6>Edition</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="edition"
                                value="{{ $book->edition }}" style="width: 400px;">

                            <h6>Book Type</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="booktype"
                                value="{{ $book->booktype }}" style="width: 400px;">

                            <button type="submit" >
                                Save
                            </button>
                    
                        </div>
                    </form>

                </div>

            </div>



    </div>

   




@endsection
