<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use\App\Models\Order;
use Razorpay\Api\Api;
use Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $rozarpayId = "rzp_test_foARm3aE3HKeko";
    private $rozarpayKey = "xg6RO0EO6MSYcvDP2SswmvUM";
    public function index()
    {
        $productData = Product::all();
        return view('product',['products'=>$productData]);
    }
    public function details($id)
    {
        $productDetails = Product::find($id);
        return view('product_details',['productDetails'=>$productDetails]);
    }
    public function searchProduct(Request $req)
    {
        $productsearch = Product::where('name','like','%'.$req->searchname.'%')->get();
        return view('search',['products'=>$productsearch]);

    }
    public function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $cart = new Cart();
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    }
    static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id',$userId)->count();
    }
    public function cartlist()
    {
        $userId = Session::get('user')['id'];
        $userCartData =  DB::table('carts')
        ->join('products','carts.product_id','products.id')
        ->select('products.*','carts.id as cart_id')
        ->where('carts.user_id',$userId)
        ->get();

        return view('cartlist',['cartdata' => $userCartData]);
       
    }
    public function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('/cartlist');
    }
    public function orderNow()
    {
        $userId = Session::get('user')['id'];
        $orderTotal = DB::table('carts')
        ->join('products','carts.product_id','products.id')
        ->select('products.*','carts.id as cart_id')
        ->where('carts.user_id',$userId)
        ->sum('products.price');

        return view('ordernow',['orderTotal' => $orderTotal]);
    }
    public function orderBook(Request $req)
    {

        $userId = Session::get('user')['id'];

        $api = new Api($this->rozarpayId, $this->rozarpayKey);

        $receiptId = str::random(20);

        $allCart= Cart::where('user_id',$userId)->get();
        foreach($allCart as $cartProduct)
        {
        //    echo  $val = $req->payment * 100;
        //    die;
            $order = $api->order->create(array(
                'receipt' => $receiptId,
                'amount' => $req->productTotal * 100,
                'currency' => 'INR'
                )
              );

              $response = [
                             'orderId' => $order['id'],
                             'rozarpayId' => $this->rozarpayId,
                             'amount' => $req->productTotal * 100,
                             'name' => $req->nameuser,
                             'currency' => 'INR',
                             'email' => $req->useremail,
                             'address' => $req->address,
                             'description' => 'Desc'
              ];

            $order = new Order();
            $order->product_id = $cartProduct['product_id'];
            $order->user_id = $cartProduct['user_id'];
            $order->address = $req->address;
            $order->status = 'pending';
            $order->payment_method = $req->payment;
            $order->payment_status = 'pending';
            $order->save();
        }
        $allCart= Cart::where('user_id',$userId)->delete();
        // return redirect('/');
        return view('payment-page',['response'=> $response]);
    }
    public function myOrders()
    {
        $userId = Session::get('user')['id'];
        $orderData = DB::table('orders')
        ->join('products','orders.product_id','products.id')
        ->select('products.*','orders.*')
        ->where('orders.user_id',$userId)
        ->get();
        return view('myorders',['orderData'=> $orderData]);
    }
    public function paymentComplete(Request $req)
    {
      
       $signStatus = $this->signatureCheck(
            $req->razorpay_signature,    
            $req->razorpay_payment_id,
            $req->razorpay_order_id,
            
        );
        // echo $signStatus;
        // die;
        if($signStatus == true)
        {
            return view('payment-success');
        }
        else
        {
            return view('payment-failed');
        }
    }
    private function signatureCheck($signature,$paymentId,$orderId)
    {
       
        try
        {
            $api = new Api($this->rozarpayId, $this->rozarpayKey);
            $attributes  = array('razorpay_signature'  => $signature,  'razorpay_payment_id'  => $paymentId ,  'order_id' => $orderId);
            echo "<pre>";
            print_r($attributes);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            // echo "<pre>";
            // print_r($order);
            return true;
        }
        catch(\Exception $e)
        {
            return false;
        }
    }
}
