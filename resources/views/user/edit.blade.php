@extends('user.profile')

@section('action')
        <div class="text">
            <h1>User Profile</h1>
        </div>

    <div class="flex justify-center pt-20">
        <form action="/user/{{ $user->id }}/edit/update" method="POST">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div id="edit-formula">
                <h6>Name</h6>
                <input 
                    type="text" 
                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                    name="name"
                    value="{{ $user->name }}" style="width: 400px;">
                <h6>Email</h6>
                <input 
                    type="text" 
                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                    name="email"
                    value="{{ $user->email }}" style="width: 400px;">
                <h6>Password</h6>
                <input 
                    type="text" 
                    class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                    name="password"
                     style="width: 400px;">
                <button type="submit" class = "btn btn-primary" >
                    Save
                </button>


            </div>
        <!--</form>-->
    </div>

@endsection


