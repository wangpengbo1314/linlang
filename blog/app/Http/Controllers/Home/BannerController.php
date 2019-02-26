<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Banner;
use DB;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = $request->input('count',3);
        $search = $request->input('search','');
        $data = Banner::where('name','like','%'. $search.'%')->paginate($count);

        $counts = DB::table('image_banner')->count();
        // 加载页面
        return view('Admin.banner-list',['data'=>$data,'request'=>$request->all(),'counts'=>$counts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // 加载模板
        return view('Admin.banner-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //  数据验证
        $this->validate($request, [
            'name' => 'required',
            'img' => 'required',
        ],[
            'name.required'=>'名称必填',
            'img.required'=>'图片必填',
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
        // dd($data);
        //压入到数据库
        // $res = DB::table('image_banner')->insert($data);
        $banner = new Banner;
        $banner->name = $data['name'];
        $banner->status = $data['status'];
        $banner->img = $data['img'];
        $res = $banner->save();
        if($res){
            return redirect('/home/banner')->with('success', '添加成功');
        }else{
            return back()->with('error', '添加失败');
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
        $banner = Banner::find($id);
        // 显示模板 加载数据
        return view('Admin.banner-edit',['banner'=>$banner]);
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
        // 修改数据
        $banner = Banner::find($id);
        $img = $banner->img;
        $banner->name = $request->input('name','');
        $banner->status = $request->input('status','');
        $banner->img = $request->input('img',$img);
         if($request->hasFile('img')){
            $file = $request->file('img');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);
        }
        $data = $request->except(['_token',]);
        $data['img'] = $img;
        // $banner = new Banner;
        // $banner->name = $data['name'];
        // $banner->status = $data['status'];
        // $banner->img = $data['img'];
        $banner->img = $request->input($data['img'],$img);
        $res = $banner->save();
        if($res){
            DB::commit();
            return redirect('/home/banner')->with('success','修改成功');
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
        // 删除数据
        DB::beginTransaction();
        $res = Banner::destroy($id);
         if($res){
            DB::commit();
            return redirect($_SERVER['HTTP_REFERER'])->with('success','删除成功');
        }else{
            DB::rollBack();
            return redirect($_SERVER['HTTP_REFERER'])->with('error','删除失败');
        }
    }
}
