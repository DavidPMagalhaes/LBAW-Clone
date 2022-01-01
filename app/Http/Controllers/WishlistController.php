<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $bookIds = Wishlist::where('userid', $id)->get();
        return view('wishlist.index',['bookIds' => $bookIds]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $wishlist = new Wishlist;

        //$this->authorize('create', $cart);

        $wishlist->name = $request->input('quantity');
        //$cart->userid = Auth::user()->id;
        $wishlist->bookId = $request->route('id');
        $wishlist->save();

        dd($wishlist);
        return $wishlist;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $wishlist = new Wishlist;
        $userid = Auth::id(); 
        
        $uniqueBook = Wishlist::where('bookid', '=', $id)
        ->where('userid', '=', $userid)   //para teste
        ->first();

        if ($uniqueBook === null) {
            
            $wishlist->userid = Auth::user()->id;

            $wishlist->bookid = $id;
    
            $wishlist->save();
    
    
            return redirect('/home');
        } 
        // User does not exist
        return redirect()->back()->with('book alredy in wishlist');
        
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
    public function destroy($id, $bookid)
    {
        $wishlist = Wishlist::where('bookid', '=', $bookid)
        ->where('userid', '=', $id);   //para teste
        //dd($cart);
        $wishlist->delete();
        return redirect()->back();
    }
}
