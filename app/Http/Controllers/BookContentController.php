<?php

namespace App\Http\Controllers;

use App\Models\BookContent;
use Illuminate\Http\Request;

class BookContentController extends Controller
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
     * Shows all cards.
     *
     * @return Response
     */
    public function list()
    {
      $bookContent = Auth::user()->cards()->orderBy('id')->get();
      return view('pages.cards', ['cards' => $cards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookContent = new BookContent();

        $this->authorize('create', $bookContent);

        $bookContent->title = $request->input('title');
        $bookContent->bookyear = $request->input('bookyear');
        $bookContent->save();

        return $bookContent;
    }

    public function delete(Request $request, $id)
    {
      $bookContent =BookContent::find($id);

      $this->authorize('delete', $bookContent);
      $bookContent->delete();

      return $bookContent;
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
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function show(BookContent $bookContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function edit(BookContent $bookContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookContent $bookContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookContent  $bookContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookContent $bookContent)
    {
        //
    }
}
