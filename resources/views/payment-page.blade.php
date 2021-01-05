<button id="rzp-button1" hidden>Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$response['rozarpayId']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "{{$response['currency']}}",
    "name": "{{$response['name']}}",
    "description": "{{$response['description']}}",
    "image": "https://example.com/your_logo",
    "order_id": "{{$response['orderId']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        //After Payment Success comes here

        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;

        document.getElementById('rzp-paymentresponse').click();
        // alert("Payment Id : "+response.razorpay_payment_id);
        // alert("Order Id : "+response.razorpay_order_id);
        // alert("Signature : "+response.razorpay_signature)
    },
    "prefill": {
        "name": "{{$response['name']}}",
        "email": "{{$response['email']}}",
        "contact": "993096133"
    },
    "notes": {
        "address": "{{$response['address']}}"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
window.onload = function(){
    document.getElementById('rzp-button1').click()
}
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

<form action="payment-complete" method="POST" hidden>
    @csrf
    <input type="text" class="form-control" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="text" class="form-control" name="razorpay_order_id" id="razorpay_order_id" >
    <input type="text" class="form-control" name="razorpay_signature" id="razorpay_signature">
                    <!-- <textarea class="form-control" name="address" placeholder="Enter your address"></textarea> -->
        <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
</form>