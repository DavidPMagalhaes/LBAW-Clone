<?php

namespace App\Http\Controllers;

use App\Models\BelongsToCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\BookContent;
use App\Models\BookProduct;

class CategoryController extends Controller
{
























    ///////////////////////////////////////////////////////////////////////////////////
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = new Category();

        // $this->authorize('create', $category);

        // $category->label = $request->input('label');
        // $category->save();

        // return $category;
    }

    public function delete(Request $request, $id)
    {
      $category = Category::find($id);

      $this->authorize('delete', $category);
      $category->delete();

      return $category;
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $category = $key;

        $categoryid = Category::where('label', '=', $category)->first();

        //dd($categoryid);
        //collection with id of bookContents of chosen category and id of category 
        $belongsToCategory = BelongsToCategory::where('categoryid', '=', $categoryid->categoryid)->get();

        //dd($belongsToCategory);

        //first entry of colletion
        $belongsToIds = $belongsToCategory[0]->bookid;


        //bookContents with requested categories 
        $bookContent = BookContent::where('bookid', '=', $belongsToIds)->get();
        //dd($bookContent);
       
        $counter = -1;
        foreach($belongsToCategory as $belongstocategory){   
            //$counter++;
            if ($counter++ == 0) continue;

            //dd($bookcontent->bookid);
            $belongsToIds = $belongstocategory->bookid;

            $tempBook = BookProduct::where('bookcontentid', '=', $belongsToIds)->get();

            $bookContent = $bookContent->merge($tempBook);
            //dd($books);
        }
        
        
        
        //dd($bookContent);

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

    public function list()
    {
      $this->authorize('list', Category::class);
      $category = Auth::category()->books();
      return view('pages.category', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
