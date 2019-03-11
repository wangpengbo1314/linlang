<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\GoodsController;

use App\Model\Admin\Cates;
use App\Model\Admin\Goods;

use DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        return view('Home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        //获取商品详情表里的信息
        $goods_info_data = DB::table('goods_info')->where('goods_id',$id)->first();
        //根据商品详情表中的goods_id获取goods表中信息
        $goods_data = DB::table('goods')->where('id',$goods_info_data->goods_id)->first();
        
        return view('Home.introduction',['goods_info_data'=>$goods_info_data,'goods_data'=>$goods_data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function info(Request $request,$id){
        
       if (!$id) {
          return back()->with('抱歉,小宝贝','此商品信息在更新中');
       }
       $data = DB::table('goods')->where('type_id',$id)->get();
        
        return view('Home.search',['data'=>$data]);
    }

    public function shopcart($id){
         $goods_data = DB::table('goods')->where('id',$id)->get();
         $goods_info_data = DB::table('goods_info')->where('goods_id',$id)->get();


        return view('Home.shopcart',['id'=>$id,'goods_data'=>$goods_data,'goods_info_data'=>$goods_info_data]);
    }
}
