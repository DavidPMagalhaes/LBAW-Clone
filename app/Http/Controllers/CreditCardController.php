<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Illuminate\Http\Request;

class CreditCardController extends Controller
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
        $creditCard = new CreditCard();

        $this->authorize('create', $creditCard);

        $creditCard->ownername = $request->input('name');
        $creditCard->cardnumber = $request->input('cardnumber');
        $creditCard->securitycode = $request->input('securitycode');

        $creditCard->userid = Auth::registered_user()->userid;
        $creditCard->save();

        return $creditCard;
    }

    public function delete(Request $request, $id)
    {
      $creditCard = credit_card::find($id);

      $this->authorize('delete', $creditCard);
      $creditCard->delete();

      return $creditCard;
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
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show(CreditCard $creditCard)
    {
        $this->authorize('show', $creditCard);
        return view('pages.creditCard', ['creditCard' => $creditCard]);
    }

    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', CreditCard::class);
      $creditCard = Auth::registered_user()->creditCards();
      return view('pages.creditCards', ['creditCards' => $creditCards]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditCard $creditCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditCard $creditCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditCard $creditCard)
    {
        //
    }
}
