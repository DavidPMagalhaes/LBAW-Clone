<?php

namespace App\Http\Controllers;

use App\Models\BookContent;
use App\Models\BookProduct;
use Illuminate\Http\Request;

class SearchBarController extends Controller
{

    public function show(Request $request, $id)
    {
        $search = $request->input('search');

        //bookContents with requested titles 
        $bookContent = BookContent::where('title', 'LIKE', '%'.$search.'%')->get();
        if(!$bookContent->isNotEmpty())
            return view('pages.empty');
       
        //ids
        $contentids = $bookContent[0]->bookid;


        $books = BookProduct::where('bookcontentid', '=', $contentids)->get();

        $counter = -1;
        foreach($bookContent as $bookcontent){   
            if ($counter++ == 0) continue;

            $contentids = $bookcontent->bookid;
            $tempBook = BookProduct::where('bookcontentid', '=', $contentids)->get();
            $books = $books->merge($tempBook);
        }


        return view('pages.search', ['books' => $books]);
    }

}
