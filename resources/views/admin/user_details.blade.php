@extends('user.profile')

@section('title', 'userInfo')

@section('content')



<h1> Profile</h1>
<br>
<div class= "profile-info" >
    <div class= "photo-name">
        <img src = {{ $user->profilepicture }} width="260" >
        <figcaption>{{ $user->name }} </figcaption>
    </div>
    <div class="space"></div>
    <div class= "information">
        <h1> Account Details: </h1><hr>
        <p2>  Username:</p2> <p3>  {{ $user->name }} </p3><hr>
        <p2>  Email: </p2> <p3>  {{ $user->email }}</p3><hr>

        <form id = "update-profile" action="/admin/user/{{$user->id}}/update" method="POST">
        {{ csrf_field() }}
                {{ method_field('put') }}
            <label for="exampleSelect1" class="form-label mt-4" form = "update-profile"  ><p2>Account status </p2></label>
                <select class="form-select" id="exampleSelect1" style =" width : 200px;">
                    @if ($user->isblocked == 'True')

                        <option value ="False">Normal</option>
                        <option value = "True" selected = "selected">Blocked</option>
                    @else

                        <option value ="False" selected = "selected">Normal</option>
                        <option value = "True" >Blocked</option>
                    @endif
            
                </select>
                <hr>
                <label for="exampleSelect1" class="form-label mt-4"><p2>User type</p2></label>
                <select class="form-select" id="exampleSelect1" style =" width : 200px;">
                    @if ($user->isadmin == 'True')
                            <option selected = "selected" value = "True">Admin</option>
                            <option value = "False" >Regular</option>
                    @else
                            <option  value = "True">Admin</option>
                            <option selected = "selected" value ="False" >Regular</option>
                    @endif
                
                </select>
                <br><br>
            <button class = "btn btn-primary" type="submit" style = "width: 200px;" >
                    Save
            </button>
            </form> 
    </div>


    </div>

    <br><br><br><br><br><br><br><br><br><br>
    
    <div>

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
