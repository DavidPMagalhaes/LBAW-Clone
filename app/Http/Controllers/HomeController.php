<?php

namespace App\Http\Controllers;

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
        return view('pages.home');
    }
    public function listBooks() {
        // $this->authorize('list', BookContent::class);
        // $books = Auth::bookProduct()->orderBy('id')->get();
        // return view('pages.home', ['books' => $books]);
    }
}
