<?php

namespace App\Http\Controllers;

use App\Models\BookContent;
use App\Models\BookProduct;
use Illuminate\Http\Request;

class SearchBarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    public function show(Request $request, $id)
    {
        $search = $request->input('search');

        //se bookContent for collection acho que nao vai funcionar
        $bookContent = BookContent::where('title', 'LIKE', '%'.$search.'%')->get();
        dd($bookContent->get('bookcontentid')[0]->bookcontentid);
        $contentids= $bookContent->get('bookcontentid')[0]->bookcontentid;
        $books = BookProduct::where('bookcontentid', '=', $contentids)->get();
        //$book = BookProduct::find($id);

        return view('pages.search', ['books' => $books]);
        //return view('pages.search', ['book' => $book]);
    }

}
