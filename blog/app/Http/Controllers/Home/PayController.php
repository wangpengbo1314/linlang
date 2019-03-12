<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Home\Orders;
use App\Model\Home\Ordersinfo;
use App\Model\Home\Comment;
class PayController extends Controller
{
    public function index(Request $request){
    	$id = $request->session()->get('homeid');
    	$address = DB::table('goods_address')->where('user_id',$id)->get();
    	$res = DB::table('goods_address')->where('status',0)->where('user_id',$id)->first();
    	$cart = DB::table('shopping_cart')->where('status',1)->get();

    	// 加载订单页面
    	return view('Home.pay',['address'=>$address,'cart'=>$cart,'res'=>$res]);
    }


    public function list(Request $request,$table){
    	$id = $request->session()->get('homeid');
    	$address = DB::table('goods_address')->where('status',0)->where('user_id',$id)->first();
    	$shop = DB::table('shopping_cart')->where('status',1)->where('user_id',$id)->get();
    	// dump($shop);
    	// 
    	$res = Orders::find(1);
    	// dump($res);
    	foreach($shop as $k=>$v){
    		$order = new Orders;
    		$order->user_id = $id;
    		$order->goods_id = $v->goods_id;
    		$order->name = $v->name;
	    	$order->price = $v->price;
	    	$order->img = $v->pic;
	    	$order->number = $v->number;
	    	$order->rand = mt_rand(1000000,9999999);
	    	$order->save();
			

	    	$info = new Ordersinfo;
	    	$info->user_id = $id;
	    	$info->goods_id = $v->goods_id;
	    	$info->orders_id = $order->id;
	    	$info->name = $v->name;
	    	$info->price = $v->price;
	    	$info->pic = $v->pic;
	    	$info->number = $v->number;
	    	$info->rand = $order->rand;
	    	$info->address_name = $address->name.$address->phone;
	    	$info->address_cmb = $address->cmbProvince.$address->cmbCity.$address->cmbArea.$address->cmbAddress;
	    	$orderinfo = $info->save();

    	}

    	$delete = DB::table('shopping_cart')->where('status',1)->where('user_id',$id)->delete();

    	return view('Home.success',['table'=>$table,'address'=>$address]);
    }

    public function orders(Request $request){
    	$id = $request->session()->get('homeid');
    	$phone = $request->session()->get('homephone');
    	$order = DB::table('orders')->where('user_id',$id)->get();
    	$shop = DB::table('shopping_cart')->where('user_id',$id)->where('status',0)->get();
    	return view('Home.order',['order'=>$order,'shop'=>$shop,'phone'=>$phone]);
    }

    public function ordersinfo(Request $request){
    	$id = $request->session()->get('homeid');
    	$orderinfo = DB::table('orders_info')->where('user_id',$id)->get();
    	return view('Home.orderinfo',['orderinfo'=>$orderinfo]);
    }

    public function show(Request $request,$id){
    	$uid = $request->session()->get('homeid');
    	$order = DB::table('orders')->where('user_id',$uid)->where('id',$id)->update(['status'=>2]);
    	

    	$orderinfo = DB::table('orders_info')->where('user_id',$uid)->where('orders_id',$id)->update(['status'=>2]);

    	return back();
    }

    public function comment(Request $request,$id){
    	$uid = $request->session()->get('homeid');
    	$order = DB::table('orders')->where('user_id',$uid)->where('id',$id)->update(['status'=>3]);
    	$orderinfo = DB::table('orders_info')->where('user_id',$uid)->where('orders_id',$id)->update(['status'=>3]);

    	$orders = DB::table('orders')->where('user_id',$uid)->where('id',$id)->get();
    	return view('Home.commentlist',['orders'=>$orders]);
    }

    public function assess(Request $request,$id){
    	 //  数据验证
        $this->validate($request, [
            'satr' => 'required',
        ],[
            'satr.required'=>'商品评价必填',
        ]);

        // 执行文件上传
        if($request->hasFile('img')){
            $file = $request->file('img');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);
            
        }

        // 接收数据
        //接收数据
        $data = $request->except(['_token']);
        
        //赋值
        $data['img'] = $img;
        $order = DB::table('orders')->where('id',$id)->first();
        // dd($data);
        $comment = new Comment;
        $comment->user_id = $order->user_id;
        $comment->goods_id = $order->goods_id;
        $comment->orders_id = $order->id;
        $comment->name = $order->name;
        $comment->pic = $order->img;
        $comment->text = $data['text'];
        $comment->satr = $data['satr'];
        $comment->img = $data['img'];
        $res = $comment->save();
        if($res){
        	return redirect('/home/pay/comments')->with('success', '添加成功');
        }else{
        	return back();
        }
    }

    public function comments(Request $request){
    	$id = $request->session()->get('homeid');
    	$comment = DB::table('goods_comment')->where('user_id',$id)->get();
    	return view('Home.comment',['comment'=>$comment]);
    }
}
