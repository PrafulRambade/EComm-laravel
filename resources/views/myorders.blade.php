@extends('master')
@section('content')
<!-- <h1>Login Page</h1> -->
<div class="custom-product">
        <div class="col-sm-10">
            <div class="tranding-wrapper">
                <h2 style="align:center">Order List</h2><br>
                
                <div class="">
                    @foreach($orderData as $productitem)
                   
                        <div class="row search-items cart-list-devider">
                            <div class="col-sm-3">
                                <a href="details/{{$productitem->id}}">
                                    <img class="tranding-img" src="{{$productitem->gallery}}" alt="Chania">
                                </a>
                            </div>
                            <div class="col-sm-3">
                                    <div class="">
                                        <h3>{{$productitem->name}}</h3>
                                        <h5>Delivery Status : {{$productitem->status}}</h5>
                                        <h5>Payment Status : {{$productitem->payment_status}}</h5>
                                        <h5>Delivery Method : {{$productitem->payment_method}}</h5>
                                        <h5>Address : {{$productitem->address}}</h5>
                                        <h5>Price : {{$productitem->price}}</h5>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</div>
@endsection