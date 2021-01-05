@extends('master')
@section('content')
<!-- <h1>Login Page</h1> -->
<div class="custom-product">
        <div class="col-sm-10">
            <div class="tranding-wrapper">
                <h2 style="align:center">Cart List for Products</h2><br>
                <a class="btn btn-success" href="/ordernow">Order Now</a><br><br>
                <div class="">
                    @foreach($cartdata as $productitem)
                        <div class="row search-items cart-list-devider">
                            <div class="col-sm-3">
                                <a href="details/{{$productitem->id}}">
                                    <img class="tranding-img" src="{{$productitem->gallery}}" alt="Chania">
                                </a>
                            </div>
                            <div class="col-sm-3">
                                    <div class="">
                                        <h3>{{$productitem->name}}</h3>
                                        <h5>{{$productitem->description}}</h5>
                                    </div>
                            </div>
                            <div class="col-sm-3">
                                <a class="btn btn-warning" href="/removecart/{{$productitem->cart_id}}">Remove From Cart</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="btn btn-success" href="/ordernow">Order Now</a>
            </div>
        </div>
</div>
@endsection