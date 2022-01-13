@extends('layouts.app')

@section('content')

<h1 class="text"> Add Review </h1>

<div class="text">
    <form action="addReview/ReviewController.php" method="POST">
        @method('PUT')
        @csrf
        <label for="rating">Rating:</label>
        <input type="text"  name="rating"><br>
        <label for="comment">Description:</label>
        <input type="text"  name="comment">
        <button type="submit" class="button">Add Review</button>
    </form>
</div>

@endsection