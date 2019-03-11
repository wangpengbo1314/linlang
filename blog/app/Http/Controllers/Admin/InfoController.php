<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsinfo;
use App\Model\Admin\Goodscomment;

use App\Model\Admin\Info;
use DB;
use App\Model\Admin\Cates;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id = '')
    {

         if (!$id) {
            return back()->with('sorry','维护中');
          } 

        $count = $request->input('count',5);
        $search = $request->input('search','');
        $goods_info_data = DB::table('goods_info')->where('goods_id',$id)->get();

        foreach ($goods_info_data as $key => $value) {
           
        }

       if(!$value->goods_id){
           return back()->with('sorry','sorry');
       }

        $goods_data1 = DB::table('goods')->where('id',$value->goods_id)->get();
        foreach ($goods_data1 as $key => $val) {
           
        }
        $goods_data = $val;

        $data = Goodsinfo::where('month_sales','like','%'.$search.'%')->where('goods_id',$val->id)->paginate($count);
        
       
        return view('Admin.info-list',['data'=>$data,'request'=>$request->all(),'goods_data'=>$goods_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function create1(Request $request,$id = ''){
        if (!$id) {
           return back()->with('sorry','无需更多信息');
        }
        $goods_info_data = DB::table('goods_info')->where('goods_id',$id);
        if ($goods_info_data) {
            return back()->with('sorry','已有详情');
        }
        
         return view('Admin.info-add',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         DB::beginTransaction();
        //检测一下是否有文件上传
       if($request->hasFile('info_pic')){
            $file = $request->file('info_pic');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);
            
        }
         //接收数据
        $data = $request->except(['_token']);
       
        $data['info_pic'] = $img;
        $info = new Goodsinfo;
        $info->info_pic = $data['info_pic'];
        $info->style_detail = $data['style_detail'];
        $info->month_sales = $data['month_sales'];
        $info->goods_rel_price = $data['goods_rel_price'];
        $info->style = $data['style'];
        $info->goods_id = $data['id'];
       
        $res1 = $info->save();

        $goodscomment = new Goodscomment;
        $goodscomment->cargo_id = $info->id;
        $res2 = $goodscomment->save();
        
        if ($res1 && $res2) {
             DB::commit();
             return redirect('admin/info/{{ $info->goods_id }}')->with('success','添加成功');
        }else{
            DB::rollBack();
             return back()->with('error','添加失败');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $goods =  Goodsinfo::find($id);
      
        //显示模板 加载数据
        return view('Admin.info-edit',['goods'=>$goods]);
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
        
         DB::beginTransaction();
        //检测一下是否有文件上传
        $goods = Goodsinfo::find($id); 
        $goods->month_sales = $request->input('month_sales','');
        $goods->goods_rel_price = $request->input('goods_rel_price','');
        $goods->style = $request->input('style','');
        $goods->style_detail = $request->input('style_detail','');
         if($request->hasFile('info_pic')){
            $file = $request->file('info_pic');
            $ext = $file->extension();
             $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);
            }

            // 拼接名称
           
        $data = $request->except(['_token']);

        $data['info_pic'] = $img ; 

        $goods->info_pic = $data['info_pic'];

        $res1 = $goods->save();
      
       

    if ($res1) {
             DB::commit();
             return redirect('admin/info/{{ $goods->goods_id }}')->with('success','修改成功');
        }else{
            DB::rollBack();
             return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //开启事务
        
        DB::beginTransaction();
        $res1 = Goodsinfo::destroy($id);
       
        //判断
         if ($res1) {
             DB::commit();
             return redirect('admin/info')->with('success','删除成功');
        }else{
            DB::rollBack();
             return back()->with('error','删除失败');
        }
        
    
    }
}
