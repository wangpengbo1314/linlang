<?php

namespace App\Http\Controllers\Admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\GoodsStoreRequest;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsinfo;
use App\Model\Admin\Goodscomment;
use App\Model\Admin\Cates;
use App\Model\Admin\Order;



class GoodsController extends Controller
{
    //封装获取分类方法
    public static function getPidCates($pid = 0){
        $cates_data = Cates::where('pid',$pid)->get();
        $array = [];
        foreach ($cates_data as $key => $value) {
          $value['sub'] = self::getPidCates($value->id);
          $array[] = $value;
        }
        return $array;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */                           
    public function index(Request $request)
    {   
       
        $count = $request->input('count',5);
        $search = $request->input('search','');
        $data = Goods::where('goods_name','like','%'.$search.'%')->paginate($count);
         
        if (!$data) {
            return back()->with('sorry','暂无数据');
        }
        return view('Admin.goods-list',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //加载模板
        return view('Admin.product-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsStoreRequest $request)
    {   
        //开启事务
        DB::beginTransaction();
        //检测一下是否有文件上传
       if($request->hasFile('goods_pic')){
            $file = $request->file('goods_pic');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);    
        }

        //接收数据
        $data = $request->except('_token');
        $data['goods_pic'] = $img ;
        $goods = New Goods;
        $goods->goods_home = $data['goods_home'];
        $goods->goods_name = $data['goods_name'];
        $goods->goods_price = $data['goods_price'];
        $goods->goods_sales = $data['goods_sales'];
        $goods->goods_pic = $data['goods_pic'];
        $goods->type_id = $data['type_id'];
        $goodsinfo = new Goodsinfo;
        $goods->goodsinfo->goods_id  = $data['id'];

        //分类名称
        $cates_data = DB::table('cates')->where('id',$goods->type_id)->get();
        $goods->type_name = $cates_data[0]->cname;

        
        //保存
        $res1 = $goods->save();
        $goodscomment1 = new Goodscomment;
        $goodscomment1->goods_id = $goods->id;
        $goodscomment1->comment_pic = $goods->goods_pic;
        $res2 = $goodscomment1->save();
        //判断添加结果
        if ($res1 && $res2) {
             DB::commit();
             return redirect('admin/goods')->with('success','添加成功');
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
      //查询对应的信息
       $goods =  Goods::find($id);
      
      
        //显示模板 加载数据
        return view('Admin.product-edit',['goods'=>$goods]);
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
        $goods = Goods::find($id); 
        $goods->goods_home = $request->input('goods_home','');
        $goods->goods_name = $request->input('goods_name','');
        $goods->goods_price = $request->input('goods_price','');
        $goods->goods_sales = $request->input('goods_sales','');
        //如果有文件上传执行操作
         if($request->hasFile('goods_pic')){
            $file = $request->file('goods_pic');
            $ext = $file->extension();
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);
            }

        $data = $request->except(['_token']);
        $data['goods_pic'] = $img ; 
        $goods->goods_pic = $data['goods_pic'];
        $res1 = $goods->save();
     
    if ($res1) {
             DB::commit();
             return redirect('admin/goods')->with('success','修改成功');
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
        $res1 = Goods::destroy($id); 
        //判断
         if ($res1) {
             DB::commit();
             return redirect('admin/goods')->with('success','删除成功');
        }else{
            DB::rollBack();
             return back()->with('error','删除失败');
        }
        
    }
}
