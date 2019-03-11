<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\Cates;
use App\Model\Admin\Goods;
class CatesController extends Controller
{
    public function getCates(){
        //获取数据并排序
        $cates_data = DB::select("select *,concat(path,',',id) as paths from cates order by paths");
        foreach ($cates_data as $key => $value) {
           //统计$value->path中 ,出现的次数
           $n = substr_count($value->path,',');
           //重复使用一个字符串
         $cates_data[$key]->cname = str_repeat('|----',$n).$value->cname;
        }
        return $cates_data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //获取所有分类
        $cates_data = Cates::all();
        //接收count 如果没有默认为5条
        $count = $request->input('count',5);
        //接收搜索参数 如果没有默认为空
        $search = $request->input('search','');
        //查询数据 并分页
        $data = Cates::where('cname','like','%'.$search.'%')->paginate($count);
        
       //加载模板 分配变量
        return view('Admin.cates-list',['cates_data'=>self::getCates(),'data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = 0)
    {
        //加载模板  分配变量 
        return view('Admin.cates-add',['cates_data'=>self::getCates(),'id'=>$id]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
       
        //处理分类路径
        if ($data['pid'] == 0) {
            $data['path'] = 0;
        }else{
            //获取父级分类的 path,id
             $parent_data = Cates::find($data['pid']);
            //获取父级分类的信息  
           $data['path'] = $parent_data->path.','.$parent_data->id;
        }
        //使用分类模型
        $cates = new Cates;
        //接收数据
        $cates->cname = $data['cname'];
        $cates->pid = $data['pid'];
        $cates->path = $data['path'];
        $res1 = $cates->save();
       //判断添加结果
        if ($res1) {
           return redirect('admin/cates')->with('success','添加成功');
        }else{

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
        //检查当前分类中是否有子分类
       $child_data =  Cates::where('pid',$id)->first();
        if ($child_data) {
            return back()->with('error','当前分类下有子分类不允许删除');
        }
        $res = Cates::destroy($id);
        if ($res) {
           return redirect('admin/cates')->with('success','删除成功');
        }else{

           return back()->with('error','删除失败');

        }
    }
}
