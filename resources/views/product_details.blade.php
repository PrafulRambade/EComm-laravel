@extends('master')
@section('content')
<!-- <h1>Login Page</h1> -->
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="detail-image" src="{{$productDetails['gallery']}}">
        </div>
        <div class="col-sm-6">
            <a href="/">Go Back</a>
            <h3>Name : {{$productDetails['name']}}</h3>
            <h3>Price : {{$productDetails['price']}}</h3>
            <h3>Category : {{$productDetails['category']}}</h3>
            <h4>Description : {{$productDetails['description']}}</p>
            <br><br>
            <form action="/addToCart" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                <button class="btn btn-success">Add To Cart</button>
            </form>
            <br/><br/>
            <button class="btn btn-primary">Buy Now</button>
        </div>
    <div>
</div>
@endsection