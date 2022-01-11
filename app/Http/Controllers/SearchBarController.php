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
        if(!$bookContent->isNotEmpty())
            return redirect('/home');
       
        //ids
        $contentids = $bookContent[0]->bookid;
        //dd($contentids);


        $books = BookProduct::where('bookcontentid', '=', $contentids)->get();

        //dd($bookContent[2]->bookid);
        $counter = -1;
        foreach($bookContent as $bookcontent){   
            //$counter++;
            if ($counter++ == 0) continue;

            //dd($bookcontent->bookid);
            $contentids = $bookcontent->bookid;
            $tempBook = BookProduct::where('bookcontentid', '=', $contentids)->get();
            //$books->push(BookProduct::where('bookcontentid', '=', $contentids)->get());
            $books = $books->merge($tempBook);
            //dd($books);
        }
        //dd($books);
        //$book = BookProduct::find($id);

        return view('pages.search', ['books' => $books]);
    }

}
