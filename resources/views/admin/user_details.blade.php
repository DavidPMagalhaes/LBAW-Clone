@extends('user.profile')

@section('title', 'userInfo')

@section('content')


        <div class="text">

            <div class="float-right">
                <img src="{{$user->profilePicture}}" width="300" height="auto">
            </div>
            <div>
                <h2>User details</h2>
                <p>id: {{$user->id}}</p>
                <p>name: {{$user->name}}</p>
                <p>email: {{$user->email}}</p>
                <p>Blocked?: {{$user->isBlocked}}</p>
                <p>Admin?: {{$user->isAdmin}}</p>
            </div>
        </div>
        <br>
        <hr>
        @foreach($orders as $order)
            <div class="order"> 
            <div> <p1 style="padding-top: 30px;"> Order date:  </p1><p style="padding-top: 30px;">   {{ $order->orderdate }}</p></div>  

                <div><p1> OwnerName:  </p1> <p>{{ $order->getCreditCard($order->creditcardid)->ownername }}</p1></div> 
                <div><p1> 
                </p1> <br> </div> 
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">

                <p1> Books Bought: </p1>
                <div class="cart-books">
                @foreach($order->getOrderInformation($order-> orderid) as $orderInformation)

                <article class="book" >
                
                    <img src="{{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->bookcover }}" width="200" height="250" >
                    <h2> {{ $orderInformation->getBookContent($orderInformation->getBookProduct($orderInformation->bookid)->bookcontentid)->title}} </h2>
                    <p> Quantity: {{ $orderInformation->quantity }}</p>
                    <form action="/admin/orders/{{$orderInformation->orderid}}/{{$orderInformation->bookid}}/updateStatus" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input 
                            type="text" 
                            class="block shadow-5xl mb-10 p-2 w-80 placeholder-gray-400"
                            name="orderstatus"
                            style="width: 400px;"
                            value="{{ $orderInformation->orderstatus }}" style="width: 400px;">
                        <button type="submit" >
                            Save
                        </button>
                    </form>
                </article>
                @endforeach
                </div>
            </div>
            </div>
        @endforeach

    </div>

   




@endsection
