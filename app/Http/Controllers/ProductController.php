<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $productData = Product::all();
        return view('product',['products'=>$productData]);
    }
}
