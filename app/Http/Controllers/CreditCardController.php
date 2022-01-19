<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        //
    }

    public function delete($id, $creditcardid)
    {
        //
    }

    public function add($id) {
        $user = User::find($id);
        return view('payment_methods.add_creditCard', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $creditCard = new CreditCard;
        $userid = Auth::id(); 

        $creditCard->userid = Auth::user()->id;
        $creditCard->ownername = $request->input('ownername');
        $creditCard->cardnumber = $request->input('cardnumber');
        $creditCard->securitycode = $request->input('securitycode');
        
        $creditCard->save();

        // send notification
        $notification = new Notification;
        $notification->notificationmessage = 'Payment Method Approved';
        $notification->userid = Auth::user()->id;
        $notification->orderid = null;
        $notification->bookid = null;
        $notification->creditcardid = $creditCard->cardid;

        $notification->save();
        
        return redirect()->action([CreditCardController::class, 'show'], ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $creditCards = CreditCard::where('userid', '=', $id)->get();
        $userid = $id;
        return view('user.payment_methods', ['creditCards' => $creditCards], ['userid' => $userid]);
    }

    public function list()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $creditCardId)
    {
        $creditCards = CreditCard::where('userid', '=', $id)->get();
        $userid = $id;
        return view('payment_methods.edit_creditCard', ['creditCards' => $creditCards]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $creditcardid)
    {
        $creditCard = CreditCard::find($creditcardid);
        $userid = Auth::id(); 

        $creditCard->ownername = $request->input('ownername');
        $creditCard->cardnumber = $request->input('cardnumber');
        $creditCard->securitycode = $request->input('securitycode');
        
        $creditCard->save();

        return redirect()->action([CreditCardController::class, 'show'], ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditCard  $creditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $creditcardid)
    {
        $creditCard = CreditCard::find($creditcardid);
        $creditCard->delete();
  
        return redirect()->back();
    }
}
