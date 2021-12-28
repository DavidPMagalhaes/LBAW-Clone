@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">User Profile</h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <div>
            <a href="{{ $user->id }}/edit">edit profile &rarr;</a>
        </div>
            <div class="block">
                <div>
                    <h2>{{ $user->name }}</h2>
                </div>
                <div>
                    <h2>{{ $user->email }}</h2>
                </div>
                <div>
                    <h2>{{ $user->userpassword }}</h2>
                </div>
            </div>
        </form>
    </div>

@endsection
