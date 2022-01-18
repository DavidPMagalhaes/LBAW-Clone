@extends('layouts.app')

@section('title', 'Books')

@section('content')

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

                            <h6>Book year</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="bookyear"
                                value="{{ $book->bookContent()->get('bookyear')[0]->bookyear }}" style="width: 400px;">
                            
                            <h6>Author</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="author"
                                value="{{ $book->getAuthor($book->bookContent()->get('authorid')[0]->authorid)->authorname }}" style="width: 400px;">
                            
                            <h6>Book cover</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="bookcover"
                                value="{{ $book->bookContent()->get('bookcover')[0]->bookcover }}" style="width: 400px;">

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

                            <h6>Book Type(physical/e-book)</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="booktype"
                                value="{{ $book->booktype }}" style="width: 400px;">

                            <h6>Category</h6>
                            @for($i=0; $i<count($categories); $i++)
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="category{{$i}}"
                                value = "{{$categories[$i]}}" style="width: 400px;">
                            @endfor

                            <button type="submit" >
                                Save
                            </button>
                    
                        </div>
                    </form>

                </div>

            </div>



    </div>

   




@endsection
