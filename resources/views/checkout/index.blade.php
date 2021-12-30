@extends('layouts.app')
int $randomNum = rand(100000,999999);
@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text">Checkout</h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <div class="text">
            <p> Succesfull checkout</p>
            <p> Cart has been cleared
        </div>
    </div>

@endsection
