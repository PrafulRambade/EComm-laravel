@extends('master')
@section('content')
<!-- <h1>Login Page</h1> -->
<div class="custom-product">
        <div class="col-sm-4">
            <h2>Filter</h2>
        </div>
        <div class="col-sm-4">
            <div class="tranding-wrapper">
                <h2 style="align:center">Result for Products</h2>
                <div class="">
                    @foreach($products as $productitem)
                        <div class="search-items">
                            <a href="details/{{$productitem['id']}}">
                                <img class="tranding-img" src="{{$productitem['gallery']}}" alt="Chania">
                                <div class="">
                                    <h3>{{$productitem['name']}}</h3>
                                    <h5>{{$productitem['description']}}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</div>
@endsection