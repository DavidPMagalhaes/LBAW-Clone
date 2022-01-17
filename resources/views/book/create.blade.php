@extends('layouts.app')

@section('title', 'Books')

@section('content')

    <div id = "bookpage">

            <div class="text">

                <div>
                    <form action="/api/books/addBook/confirmed" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div id="edit-formula">
                            <h6>Title</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="title">

                            <h6>Book year</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="bookyear">

                            <h6>Author</h6>
                                <input 
                                    type="text" 
                                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                    name="author">
                            
                            <h6>Book cover</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="bookcover">

                            <h6>Price</h6>
                                <input 
                                    type="text" 
                                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                    name="price">

                            <h6>Stock</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="stock">

                            <h6>Publisher</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="publisher">

                            <h6>Edition</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="edition">

                            <h6>Book Type(physical/e-book)</h6>
                            <input 
                                type="text" 
                                class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                                name="booktype">

                            <button type="submit" >
                                Save
                            </button>
                    
                        </div>
                    </form>

                </div>

            </div>



    </div>

   




@endsection
