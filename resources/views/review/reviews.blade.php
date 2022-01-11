@extends('book.view')

@section('reviews')

<div class="text">
  <h1> Reviews </h1>
</div>
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