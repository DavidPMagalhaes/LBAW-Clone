<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        /*
        $cart = []; 
        foreach(session('products') as $session){
            $tempCart=Cart::find($session->id);
            $cart[] = $tempCart;
        }
        return view('pages.checkout')->with('products ',$products);
        */
        //supostamente devolve todos as rows com aquele user id
        $bookIds = Cart::where('userid', $id)->get();
        //dd($bookIds);

        //return view('cart.index')->with('bookIds', $bookIds);
        return view('cart.index',['bookIds' => $bookIds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cart = new Cart();

        //$this->authorize('create', $cart);

        $cart->name = $request->input('quantity');
        //$cart->userid = Auth::user()->id;
        $cart->bookId = $request->route('id');
        $cart->save();

        dd($cart);
        return $cart;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $cart = new Cart;
        $userid = Auth::id(); 
        
        $uniqueBook = Cart::where('bookid', '=', $id)
        ->where('userid', '=', $userid)   
        ->first();
        /*
        $uniqueBook = Cart::where(['bookid', '=', '$id'],
        ['userid', '==', '1'])->first();
        */
        if ($uniqueBook === null) {
            
                    $cart->quantity = $request->input('quantity');
                    $cart->userid = Auth::user()->id;
                    //$cart->userid = 1; //so para testar
                    //$cart->bookid = $request->route('id');
                    $cart->bookid = $id;
            
                    $cart->save();
            
            
                    return redirect('/home');
        // User does not exist
        } 
        return redirect()->back()->with('book alredy in cart');
        

        //$this->authorize('create', $cart);
    }

    public function delete(Request $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::find($id);
        $this->authorize('show', $cart);
        return view('cart.index', ['cart' => $cart]); 
    }

    public function list()
    {
      //if (!Auth::check()) return redirect('/login');
      //$this->authorize('list', Cart::class);
      //$carts = Auth::registered_user()->carts()->orderBy('id')->get();
      //return view('pages.carts', ['carts' => $carts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $bookid)
    {
        $cart = Cart::where('bookid', '=', $bookid)
        ->where('userid', '=', $id);   //para teste
        //dd($cart);
        $cart->delete();
        return redirect()->back();
    }
}
