<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use \Debugbar;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {

        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        //dd($request);
        \Debugbar::info($request);
        \Debugbar::error("Hello");
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        
        //$data = DB::table('tbl_product')->where('product_id',$productID)->get();
        //dd($request);

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        //Cart::destroy();
        //-> trỏ ra tức là lấy ra trường product_id trong product_info

        $data['id'] = $productId;
        $data['qty'] = $quantity;
        $data['name'] =  $product_info->product_name;
        $data['price'] =  $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        // thêm vào trường data
        Cart::add($data);
        // sau khi thêm vào cart rồi thì trả về /show_cart
       return Redirect::to('/show-cart');

    }
     public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
}
