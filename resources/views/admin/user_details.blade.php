@extends('user.profile')

@section('title', 'Books')

@section('information')

    <div id = "bookpage">

            <div class="text">

                <div class="float-right">
                    <img src="{{$user->profilePicture}}" width="300" height="auto">
                </div>
                <div>
                    <h2>User details</h2>
                    <p>id: {{$user->id}}</p>
                    <p>name: {{$user->id}}</p>
                    <p>email: {{$user->id}}</p>
                    <p>isBlocked: {{$user->id}}</p>
                    <p>isAdmin: {{$user->id}}</p>
                    <p>profilePicture: {{$user->id}}</p>
                </div>

                <div>
                    <form action="/api/books/addBook/confirmed" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div id="edit-formula">
                            <button type="submit" >
                                Save
                            </button>
                    
                        </div>
                    </form>

                </div>

            </div>



    </div>

   




@endsection
