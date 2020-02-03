<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Product;
use Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    function addproductview (){
        $products = product::paginate(3);
        $deleted_products = product::onlyTrashed()->get();
       return view('product/view',compact('products','deleted_products'));


    }

    function addproductinsert (Request $request){
       $request->validate([
            'product_name'=>'required',
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'product_quantity'=>'required|numeric',
            'alert_quantity'=>'required|numeric',

        ]);



      $last_inserted_id = product::insertGetId([
          'product_name'=> $request->product_name,
          'product_description'=> $request->product_description,
          'product_price'=> $request->product_price,
          'product_quantity'=> $request->product_quantity,
          'alert_quantity'=> $request->alert_quantity,

      ]);
      if ($request->hasFile('product_image')){
          $photo_to_upload =$request->product_image;
          $filename =$last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();

          $t = Image::make($photo_to_upload)->resize(15,15)->save(base_path('public/uploads/product_photos'.$filename));


      }


      return back()->with('status','Product inserted successfully!');

    }

    function deleteproduct($product_id){



       // return product::find($product_id);
        product::find($product_id)->delete();
        return back()->with('deletestatus','Product deleted successfully!');

    }

    function editproduct($product_id){

      $single_product_info = product::findOrFail($product_id);

      return view('product/edit', compact('single_product_info'));

    }

    function editproductinsert(Request $request){
        Product::find($request->product_id)->update([
            'product_name'=> $request->product_name,
            'product_description'=> $request->product_description,
            'product_price'=> $request->product_price,
            'product_quantity'=> $request->product_quantity,
            'alert_quantity'=> $request->alert_quantity,
        ]);
        return back()->with('status','Product edited successfully!');

    }

    function restorproduct($product_id){
        echo "$product_id";
        Product::onlyTrashed()->where('id', $product_id)->restore();
        return back();
    }

    function forcedeleteproduct($product_id){

        Product::onlyTrashed()->find ($product_id)->forceDelete();
        return back();
    }





}
