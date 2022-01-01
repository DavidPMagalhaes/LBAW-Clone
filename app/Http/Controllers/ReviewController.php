<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\BookContent;
use App\Models\BookProduct;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $review = new Review();

        $this->authorize('create', $review);

        $review->rating = $request->input('rating');
        $review->reviewcomment = $request->input('comment');
        $review->userid = Auth::registered_user()->userid;
        $review->save();

        return $review;
    }

    public function delete(Request $request, $id)
    {
      $review = Review::find($id);

      $this->authorize('delete', $review);
      $review->delete();

      return $review;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reviews = Review::where('bookid', '=', $id)->get();
        $book = BookProduct::find($id);
        $book = BookContent::find($book->bookcontentid);
        return view('review.reviews', ['reviews' => $reviews], ['book' => $book]);
    }

    public function list()
    {
      $this->authorize('list', Card::class);
      $reviews = Auth::bookProduct()->reviews()->orderBy('reviewid');
      return view('pages.reviews', ['reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
