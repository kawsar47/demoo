<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
class FrontendController extends Controller
{

    function index (){

       $products = Product::all();
        return view('Welcome',compact('products'));

    }
    function contact (){
        return view('contact');

    }

    function about (){
        return view('about');
    }

    function productdetails($product_id){

       $single_product_info = product::find($product_id);
       $related_products = product::where('id','!=', $product_id)->get();
        return view('frontend/productdetails',compact('single_product_info','related_products'));
    }





}
