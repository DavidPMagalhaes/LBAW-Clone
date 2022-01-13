@extends('book.view')

@section('reviews')


<div class="text">
  <h1> Reviews </h1>
</div>
<div id = "comment">
<div class = "profile-comment">

    </div>

  <div class = "comment-content">
    <div class="text">
        <form action="addReview/ReviewController.php" method="POST">
            @method('PUT')
            @csrf
            <label for="rating">Rating:</label>
            <input type="number" value = 1 min=1 max=5
                                name="rating" >
            <label for="comment">Comment:</label>
            <input type="text"  name="comment">
            <button type="submit" class="red-button">Add Review</button>
        </form>
    </div>
  </div>
</div>
<br>
@foreach($reviews as $review)


  <div id = "comment">

   
    <div class = "profile-comment">
      <img src = {{ $review->getUser($review->userid)->profilepicture }} width="100" border-radious = "50%" >
      <p>  {{ $review->getUser($review->userid)->name }} </p>
    </div>

    <div class = "comment-content">
      <div style="font-size: 30px; padding-top: 5px;">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star "></span>
        <span class="fa fa-star"></span>
      </div>
      <p> {{ $review->reviewcomment }}</p>
      @if (Auth::check() && $review->userid === Auth::id())
      <div class= "buttons">
        <div id = "remove">
          <form action="/user/{{ $review->userid }}/review-history/{{ $review->reviewid }}/delete" method="POST">
            @method('delete')
            @csrf
            <div>
              <button type="submit" class="red-button">Remove</button>
            </div>
          </form>
        </div>	

        <a href="/user/{{ $review->userid }}/review-history/{{ $review->reviewid }}/edit" class="button">Editar</a>
      </div>
      @endif

</div>
    

    <!--<p> Rating: {{ $review->rating }} </p>-->
      
  </div>
  <br>
  @endforeach


@endsection