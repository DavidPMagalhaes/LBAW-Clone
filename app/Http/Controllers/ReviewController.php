<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\BookContent;
use App\Models\BookProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function addReviewForm($id) {
        $book = BookProduct::find($id);
        return view('review.add_review', ['book' => $book]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function delete(Request $request, $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $review = new Review;
        $userid = Auth::id(); 

        $review->userid = Auth::user()->id;
        $review->bookid = $id;
        $review->rating = $request->input('rating');
        $review->reviewcomment = $request->input('comment');
        
        $review->save();

        return redirect()->action([BookProductController::class, 'show'], ['id' => $review->bookid]);
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
