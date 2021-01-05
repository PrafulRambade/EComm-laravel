@extends('master')
@section('content')
<!-- <h1>Login Page</h1> -->
<div class="custom-product">
        <div class="col-sm-6 col-offset-2">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>Price</td>
                    <td>{{$orderTotal}} Rupees</td>
                   
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>0 Rupees</td>
                </tr>
                <tr>
                    <td>Deliver Charges</td>
                    <td>100 Rupees</td>
                    
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>{{$orderTotal+100}} Rupees</td>
                    
                </tr>
                </tbody>
            </table>

            <form action="/orderbook" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="nameuser" value="{{Session::get('user')['name']}}">
                    <input type="hidden" name="useremail" value="{{Session::get('user')['email']}}">
                    <input type="hidden" name="productTotal" value="{{$orderTotal+100}}">
                    <textarea class="form-control" name="address" placeholder="Enter your address"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Payment method</label>
                    <p><input type="radio" value="onlinepayment" name="payment"> <span>Online Payment</span></p>
                </div>
                
                <button type="submit" class="btn btn-primary">Proceed for Buy</button>
            </form>
        </div>
</div>
@endsection