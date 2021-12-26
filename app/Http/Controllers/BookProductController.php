<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use Illuminate\Http\Request;

class BookProductController extends Controller
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
        $bookProduct = new BookProduct();

        $this->authorize('create', $bookProduct);

        $bookProduct->price = $request->input('price');
        $bookProduct->stock = $request->input('stock');
        $bookProduct->bookcontentid = Auth::bookcontentid()->bookid;
        $bookProduct->save();

        return $bookProduct;
    }

    public function delete(Request $request, $id)
    {
      $bookProduct = BookProduct::find($id);

      $this->authorize('delete', $bookProduct);
      $bookProduct->delete();

      return $bookProduct;
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
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BookProduct $bookProduct)
    {
        $this->authorize('show', $bookProduct);
        return view('pages.book', ['bookProduct' => $bookProduct]);
    }

    public function list()
    {
        $this->authorize('list', BookProduct::class);
        $bookProduct = Auth::books()->orderBy('id')->get();
        return view('pages.books', ['books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(BookProduct $bookProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookProduct  $bookProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookProduct $bookProduct)
    {
        //
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
