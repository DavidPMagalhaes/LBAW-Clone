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

        //bookContents with requested titles 
        $bookContent = BookContent::where('title', 'LIKE', '%'.$search.'%')->get();
        //dd($bookContent);
       
        //ids
        $contentids = $bookContent[0]->bookid;
        //dd($contentids);


        $books = BookProduct::where('bookcontentid', '=', $contentids)->get();

        dd($bookContent);
        $counter = 0;
        foreach($bookContent as $bookcontent){   
            if ($counter == 0) continue;

            //dd($bookcontent[$counter]);
            if(!$bookcontent[$counter]->bookid) continue;
            $contentids = $bookcontent[$counter]->bookid;
            $books->add(BookProduct::where('bookcontentid', '=', $contentids)->get());
            $counter++;
        }
        //dd($books);
        //$book = BookProduct::find($id);

        return view('pages.search', ['books' => $books]);
        //return view('pages.search', ['book' => $book]);
    }

}
