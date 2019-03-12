<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrderController extends Controller
{

    public function index(Request $request){
    	$id = $request->session()->get('homeid');
    	$order = DB::table('orders')->where('user_id',$id)->get();
    	return view('Admin.product-brand',['order'=>$order]);
    }

    public function show(Request $request){
    	$id = $request->input('id');
    	$uid = $request->session()->get('homeid');
    	$order = DB::table('orders')->where('user_id',$uid)->where('id',$id)->update(['status'=>1]);
    	

    	$orderinfo = DB::table('orders_info')->where('user_id',$uid)->where('orders_id',$id)->update(['status'=>1]);
    	
    	echo $order;
    	
    }


}
