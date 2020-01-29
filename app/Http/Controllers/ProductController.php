<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    function addproductview (){
        $products = product::paginate(3);
        return view('product/view',compact('products'));


    }

    function addproductinsert (Request $request){

        $request->validate([
            'product_name'=>'required',
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'product_quantity'=>'required|numeric',
            'alert_quantity'=>'required|numeric',

        ]);



      product::insert([
          'product_name'=> $request->product_name,
          'product_description'=> $request->product_description,
          'product_price'=> $request->product_price,
          'product_quantity'=> $request->product_quantity,
          'alert_quantity'=> $request->alert_quantity,

      ]);
      return back()->with('status','Product inserted successfully!');

    }

    function deleteproduct($product_id){



        return product::find($product_id);
        product::find($product_id)->delete();
        return back()->with('deletestatus','Product deleted successfully!');

    }

    function editproduct($product_id){

      $single_product_info = product::findOrFail($product_id);

      return view('product/edit', compact('single_product_info'));

    }

    function editproductinsert(Request $request){
        product::find($request->product_id)->update([
            'product_name'=> $request->product_name,
            'product_description'=> $request->product_description,
            'product_price'=> $request->product_price,
            'product_quantity'=> $request->product_quantity,
            'alert_quantity'=> $request->alert_quantity,
        ]);
        return back()->with('status','Product edited successfully!');

    }




}
