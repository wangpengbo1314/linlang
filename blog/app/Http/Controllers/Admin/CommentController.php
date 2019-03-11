<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\Goodsinfo;
use App\Model\Admin\Goodscomment;
use App\Model\Admin\Goods;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id = '')
    {
        //id为商品详情的ID
        
        if (!$id) {
            return back()->with('sorry','维护中');
          } 
        $count = $request->input('count',5);
        $search = $request->input('search','');
        

       $goods_info_data = DB::table('goods_info')->where('id',$v->cargo_id)->get();

        foreach ($goods_info_data as $key => $value) {
          
       }
        
        //查询商品表中信息 根据详情表中的goods_id
        $goods_data = DB::table('goods')->where('id',$value->goods_id)->first();

        $data = Goodscomment::where('goodsname','like','%'.$search.'%')->paginate($count);
        
        
        return view('Admin.goodscomment-list',['data'=>$data,'request'=>$request->all(),'goods_data'=>$goods_data,'goods_info_data'=>$goods_info_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        // $comment = new Goodscomment;
        // //查询商品详情表中id为评论表中cargo_id的
        // $goodsinfo = DB::table('goods_info')->where('id',1)->get();
        // $comment->cargo_id = $goodsinfo[0]->id;
        // //查询出goodsinfo表中的数据 再根据goods_id查出商品表里面的信息
        // //1.取出goods_id
        // $goods_id = $goodsinfo[0]->goods_id;
        // //2.用goods_id去查询goods表中的信息
        // $goods_data = DB::table('goods')->where('id',$goods_id)->get();

        // //3.取出goods_name字段
        // $goods_name = $goods_data[0]->goods_name;
        // //4.压入数组
        
        
    }

    public function create1(Request $request,$id = ''){

        if (!$id) {
            return back()->with('sorry','评论更新中');
        }

        $goods_info_data = DB::table('goods_info')->where('id',$id)->first();
       
       
        $goods_data = DB::table('goods')->where('id',$goods_info_data->goods_id)->first();
        
      return view('Admin.goodscomment-add',['id'=>$id,'goods_info_data'=>$goods_info_data,'goods_data'=>$goods_data]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //开启事务
        DB::beginTransaction();
        
        //接收数据
        $data = $request->except(['_token']);
       
        $comment = new Goodscomment;
    
        $comment->comment_info = $data['comment_info'];
        
        $comment->star = $data['star'];
        $comment->cargo_id = $data['id'];
        $goods_info_data = DB::table('goods_info')->where('id',$comment->cargo_id)->first();
        $comment->comment_pic = $goods_info_data->info_pic;
        
        $comment->goods_id = $goods_info_data->goods_id;
        $goods_data = DB::table('goods')->where('id',$comment->goods_id)->first();
        $comment->goodsname = $goods_data->goods_name;
        $res1 = $comment->save();
        //判断添加结果 
        if ($res1) 
        {
             DB::commit();
             return redirect('admin/comment/index/{{ $comment->goods_id }}')->with('success','添加评论成功');   
        }else{
             DB::rollBack();
             return back()->with('error','添加评论失败');
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
        //查询有没有符合删除条件的删除对象
        $res1 = Goodscomment::where('id',$id)->delete();
         if ($res1) 
        {
             DB::commit();
             return redirect('admin/comment')->with('success','删除评论成功');     
        }else{

             DB::rollBack();
             return back()->with('error','删除评论失败');
        }
    }
}
