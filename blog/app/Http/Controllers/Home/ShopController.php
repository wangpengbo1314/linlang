<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ShopController extends Controller
{
    public function index(Request $request){
        $id = $request->session->get('homeid');
    	$data = DB::table('shopping_cart')->where('id',1)->get();
    	// 购物车页面
    	return view('Home.shopcart',['data'=>$data]);
    }

    public function show(Request $request){
    	$id = $request->session()->get('homeid');
    	$data = $request->except('_token');
    	$shop = new Shopping;
    	$shop->user_id = $id;
    	$shop->info_id = 1;
    	$shop->name = $data['name'];
    	$shop->number = $data['number'];
    	$shop->price = $data['price'];
    	$shop->img = $data['img'];
    	$shop->spec = $data['spec'];
    	$shop->style = $data['style'];
    	$res = $shop->save();
    	if($res){
    		return redirect('/home/shop/index')->with('success','添加成功');
    	}else{
    		return redirect('/home/shop/index')->with('success','添加失败');
    	}
    }

    public function jia(Request $request){
        $id = $request->input('id');
        $res = DB::table('shopping_cart')->where('id',$id)->first();
        $shop = $res->number+1;
    	$data = DB::table('shopping_cart')->where('id',$id)->update(['number'=>$shop]);
        $ress = DB::table('shopping_cart')->where('id',$id)->first();
        $json = [
            'number'=>$ress->number,
            'price'=>$ress->price
        ];
        echo json_encode($json);
    	// if($data){
    	// 	return back();
    	// }else{
    	// 	return back();
    	// }
    }

    public function jian(Request $request){
        $id = $request->input('id');
        $res = DB::table('shopping_cart')->where('id',$id)->first();
        if($res->number < 2){
            $res->number = 1;
        }
        $shop = $res->number-1;
        $data = DB::table('shopping_cart')->where('id',$id)->update(['number'=>$shop]);
        $ress = DB::table('shopping_cart')->where('id',$id)->first();
        $json = [
            'number'=>$ress->number,
            'price'=>$ress->price
        ];
        echo json_encode($json);
        // if($data){
        //     return back();
        // }else{
        //     return back();
        // }
    }

}
