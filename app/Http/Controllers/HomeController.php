<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $books = BookProduct::all();
        return view('pages.home', ['books' => $books]);
    }
}
