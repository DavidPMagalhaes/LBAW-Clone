<?php

namespace App\Http\Controllers;

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

    public function show($id)
    {
        //$search = $request->search;

        $book = BookProduct::find($id);

        return view('pages.search', ['book' => $book]);
    }

}
