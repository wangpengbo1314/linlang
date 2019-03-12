<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Home\Goods;
use App\Model\Home\Goodsinfo;
use App\Model\Home\Collection;
class CollectionController extends Controller
{
    public function index(Request $request){
    	$id = $request->session()->get('homeid');
    	$count = DB::table('shopping_cart')->where('user_id',$id)->count();
    	
    	// dump($collection->id);
    	$data = Goods::where('id',1)->first();
        $datainfo = $data->goodsinfo->id;
        $collection = Collection::where('goodsinfo_id',$datainfo)->first();
    	return view('Home.introduction',['data'=>$data,'count'=>$count,'collection'=>$collection]);
    }

    public function show(Request $request){
    	
        $data['user_id'] = $request->session()->get('homeid');
        $data['price'] = $request->input('price');
        $data['name'] = $request->input('goods_name');
        $data['pic'] = $request->input('goods_pic');
        $data['rel_price'] = $request->input('rel_price');
        $data['month_sales'] = $request->input('month_sales');
        $data['goodsinfo_id'] = $request->input('goodsinfo_id');
        $res = DB::table('goods_collection')->insert($data);
        echo $res;

    }

    public function list(Request $request){
    	$id = $request->session()->get('homeid');
    	$phone = $request->session()->get('homephone');
    	$data = DB::table('goods_collection')->where('user_id',$id)->get();
        // dump($data);
    	// 收藏页面
    	return view('Home.collection',['data'=>$data,'phone'=>$phone]);
    }

    public function delete(Request $request,$id){
    	$res = DB::table('goods_collection')->where('id',$id)->delete();
    	if($res){
    		return redirect('/home/collection/list')->with('success','取消收藏成功');
    	}else{
    		return redirect('/home/collection/list')->with('success','取消收藏失败');
    	}
    	
    }
}
