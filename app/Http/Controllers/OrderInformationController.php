<?php

namespace App\Http\Controllers;

use App\Models\OrderInformation;
use App\Models\UserOrder;
use App\Models\Cart;
use App\Models\BookProduct;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderInformationController extends Controller
{


    public function checkout($id)
    {

        //default credit card that user has saved
        $creditCard = CreditCard::where('userid', $id)->first();
        
        $bookIds = Cart::where('userid', $id)->get();
        
        // $order = UserOrder::where('user_id', '=', $id)
        // ->first();
        // $this->authorize('show', $order);
        return view('checkout.index', ['bookIds' => $bookIds])->with('creditCard', $creditCard); 
    }


    public function confirmedCheckout(Request $request, $id)
    {
        //falta diminuir o stock


        //default credit card that user has saved
        $creditCard = CreditCard::where('userid', $id)->first();
        
        $bookIds = Cart::where('userid', $id)->get();


        // $this->authorize('show', $order);

        $orderid = rand(10000000,999999999);
        $userOrder = new UserOrder;
        $userOrder->userid = Auth::user()->id;
        $userOrder->orderdate = Carbon::now()->toDateTimeString();
        //alterar id e orderid
        $userOrder->orderid = $orderid;
        $userOrder->creditcardid = $creditCard->cardid;
        //dd($userOrder);
        $userOrder->save();
        
        foreach($bookIds as $book){   

            //dd($book->bookid($book->bookid)->price );
            $orderInformation = new OrderInformation;
            $orderInformation->orderid = $orderid;
            //vai ser preciso um for dps
            $orderInformation->bookid = $book->bookid;
            $orderInformation->pricebought = $book->bookid($book->bookid)->price;
            $orderInformation->orderstatus = 'PROCESSING';
            $orderInformation->quantity = $book->quantity;
            //dd($orderInformation);
            $orderInformation->save();

        }
        
        //to empty cart
        $carts = Cart::where('userid', $id)->get();
        foreach($carts as $cart) {
            $cart->destroy($id, $cart->bookid);
        }

        return redirect()->back();


    }





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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $orderInformation = new OrderInformation;
        // $orderInformation->bookid = 1;
        // $orderInformation->priceBought = 1;
        // $orderInformation->orderStatus = 'PROCESSING';
        // $orderInformation->quantity = 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderInformation  $orderInformation
     * @return \Illuminate\Http\Response
     */
    public function show(OrderInformation $orderInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderInformation  $orderInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderInformation $orderInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderInformation  $orderInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderInformation $orderInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderInformation  $orderInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderInformation $orderInformation)
    {
        //
    }
}
