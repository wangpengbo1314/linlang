<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Home\User;
use App\Model\Home\Shopping;
class ShopController extends Controller
{
    public function index(Request $request){
        $id = $request->session()->get('homeid');
    	$date = DB::table('shopping_cart')->where('user_id',$id)->get();
    	// 购物车页面
    	return view('Home.shopcart',['date'=>$date]);
    }

    public function show(Request $request){
    	
        $data['user_id'] = $request->session()->get('homeid');
        $data['price'] = $request->input('price');
        $data['rel_price'] = $request->input('rel_price');
        $data['number'] =$request->input('number');
        $data['name'] = $request->input('goods_name');
        $data['pic'] = $request->input('goods_pic');
        $data['goods_id'] = $request->input('goods_id');

        $res = DB::table('shopping_cart')->insert($data);
        echo $res;
    }

    

    public function jia(Request $request,$id){
        $res = DB::table('shopping_cart')->where('id',$id)->first();
        $shop = $res->number+1;
    	$data = DB::table('shopping_cart')->where('id',$id)->update(['number'=>$shop]);
      
    	if($data){
    		return back();
    	}else{
    		return back();
    	}
    }

    public function jian(Request $request,$id){
        $res = DB::table('shopping_cart')->where('id',$id)->first();
        
        $shop = $res->number-1;
        if($shop < 1){
            $shop = 1;
        }
        $data = DB::table('shopping_cart')->where('id',$id)->update(['number'=>$shop]);
        
        if($data){
            return back();
        }else{
            return back();
        }
    }

    public function delete(Request $request,$id){
        $data = DB::table('shopping_cart')->where('id',$id)->delete();
        if($data){
            return back();
        }else{
            return back();
        }
    }

    public function revise(Request $request){
        $id = $request->input('id');
        $data = DB::table('shopping_cart')->where('id',$id)->first();
        if($data->status == 0){
           $date =  DB::table('shopping_cart')->where('id',$id)->update(['status'=>1]);
        }
        if($data->status == 1){
           $date =  DB::table('shopping_cart')->where('id',$id)->update(['status'=>0]);
        }
        echo $date;
    }

    public function check(Request $request){
        $id = $request->session()->get('homeid');
        $data = DB::table('shopping_cart')->where('user_id',$id)->get();
        if($data->status == 0){
            $date = DB::table('shopping_cart')->where('user_id',$id)->update(['status'=>1]);
        }
        if($data->status == 1){
            $date = DB::table('shopping_cart')->where('user_id',$id)->update(['status'=>0]);
        }
        echo $date
    }

    public function update(Request $request){
        $id = $request->session()->get('homeid');
       $data = DB::table('shopping_cart')->where('user_id',$id)->get();
        if($data->status == 1){
            $date = DB::table('shopping_cart')->where('user_id',$id)->delete();
        }else{
            echo "<script>alert('请全选后再删除');location.href='/home/shop/index'</script>";
        }
        return back();

    }
 
}
