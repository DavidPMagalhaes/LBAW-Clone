<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookProduct;
use App\Models\BookContent;
use Illuminate\Http\Request;

class BookProductController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    public function delete(Request $request, $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookProduct = new BookProduct;
        $bookContent = new BookContent;

        $author = Author::where('authorname', '=', $request->input('author'))->first();

        if($author){
            $bookContent->authorid = $author->authorid;
        }
        else{
            $newAuthor = new Author;
            $newAuthor->authorname = $bookContent->authorid = $request->input('author');
            $newAuthor->description = " ";
            $newAuthor->save();

            $bookContent->authorid = $newAuthor->authorid;
            //dd($newAuthor);
        }
 
        $bookContent->title = $request->input('title');
        $bookContent->bookyear = $request->input('bookyear');
        $bookContent->average = 0.0;
        $bookContent->bookcover = $request->input('bookcover');
        $bookContent->save();
    
        $bookProduct->price = $request->input('price');
        if($bookProduct->booktype == 'e-book'){
            $bookProduct->stock = 0;
        }
        else $bookProduct->stock = $request->input('stock');
        $bookProduct->publisher = $request->input('publisher');
        $bookProduct->booktype = $request->input('booktype');
        $bookProduct->bookcontentid = $bookContent->bookid;
        $bookProduct->save();



        return redirect('/home');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = BookProduct::find($id);
        return view('book.view')->with('book', $book);
    }

    public function list()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = BookProduct::find($id);
        return view('book.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bookProduct = BookProduct::find($id);
    
        $bookContent = $bookProduct->bookid($bookProduct->bookcontentid);

        $author = Author::where('authorname', '=', $request->input('author'))->first();

        if($author){
            $bookContent->authorid = $author->authorid;
            //dd($author);
        }
        else{
            $newAuthor = new Author;
            $newAuthor->authorname = $bookContent->authorid = $request->input('author');
            $newAuthor->description = " ";
            $newAuthor->save();

            $bookContent->authorid = $newAuthor->authorid;
            //dd($newAuthor);
        }
        
        if($bookContent) {
            $bookContent->title = $request->input('title');
            $bookContent->bookyear = $request->input('bookyear');
            //$bookContent->authorid = $request->input('authorid');
            $bookContent->bookcover = $request->input('bookcover');
            //dd($bookContent);
            $bookContent->save();
        }
        
        if($bookProduct) {
            $bookProduct->price = $request->input('price');
            if($bookProduct->booktype == 'e-book'){
                $bookProduct->stock = 0;
            }
            else $bookProduct->stock = $request->input('stock');
            
            $bookProduct->publisher = $request->input('publisher');
            $bookProduct->booktype = $request->input('booktype');
            $bookProduct->bookcontentid = $bookContent->bookid;
            $bookProduct->save();
        }
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookProduct $bookProduct)
    {
        //
    }
}
