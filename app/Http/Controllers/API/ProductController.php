<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
 
 
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(request $request)
    { 
        try { 
          /*    $name=$request->name;
             $products =  Product::orWhere('product_name', 'like',  '%'.$request->product_name.'%')->with('vendor')->whereHas('vendor',function($q) use ($name){
           $q->Where('name', 'like',  '%'.$name.'%');
        })->get();*/
        
        $lang='ar'; 
        if($request->lang!=''){
          $lang=$request->lang; 
        }
        $name=$request->name; 
        $sort=$request->sort; 
        $from=$request->from; 
        $to=$request->to;
        $products = Product:: leftJoin('products_translations', 'products.id', '=', 'products_translations.product_id')
        ->leftJoin('vendors', 'vendors.id', '=', 'products.vendor_id')
        ->where('products_translations.locale', $lang) ;
            
     if ($request->product_name!='') {
      $products = $products->Where('products_translations.product_name', 'like',  '%'.$request->product_name.'%');
  }    
  if ($name!='') {
     $products = $products->Where('vendors.name', 'like',  '%'.$name.'%');
 } 
 if ($from!='') {
    $products = $products->Where('price', '>',  $from);
} 
if ($to!='') {
  $products = $products->Where('price', '<',  $to);
}
if ($sort!='') {//price or orders_count or votes
  $products = $products->orderBy($sort, 'desc');
} 
    $products = $products->get();
            foreach ($products as $key => $product) {
 
              echo $product->id; echo $product['vendor']['name'];
  
            } 
        } catch (\Throwable $th) {
            return $th;
            return $this->errorStatus(__('Error'));
        }
    }
  
}
