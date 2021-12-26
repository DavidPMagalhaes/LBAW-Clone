<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
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
        $wishlist = new Wishlist();

        $this->authorize('create', $wishlist);

        $wishlist->bookid = $request->input('bookid');
        $wishlist->userid = Auth::registered_user()->userid;
        $wishlist->save();

        return $wishlist;
    }

    public function delete(Request $request, $id)
    {
        $wishlist = Wishlist::find($id);

        $this->authorize('delete', $wishlist);
        $wishlist->delete();

        return $wishlist;
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
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        $this->authorize('show', $wishlist);
        return view('pages.wishlist', ['wishlist' => $wishlist]);
    }

    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Wishlist::class);
      $books = Auth::registered_user()->wishlist();
      return view('pages.books', ['books' => $books]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
