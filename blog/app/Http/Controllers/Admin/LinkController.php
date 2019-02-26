<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Link;
use DB;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $count = $request->input('count',5);
        $search = $request->input('search','');
        $data = Link::where('name','like','%'. $search.'%')->paginate($count);

        $counts = DB::table('friendly_link')->count();
        // 加载视图
        return view('admin.link-list',['data'=>$data,'request'=>$request->all(),'counts'=>$counts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载模板
        return view('Admin.link-create');
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
        //  数据验证
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
            'text' => 'required',
        ],[
            'name.required'=>'名称必填',
            'url.required'=>'网址必填',
            'url.url'=>'网址格式不对',
            'text.required'=>'内容必填',
        ]);
        // 接收数据
        $data = $request->except('_token');
        $link = new Link;
        $link->name = $data['name'];
        $link->url = $data['url'];
        $link->text = $data['text'];
        $res = $link->save();
        if($res){
            DB::commit();
            echo '<script>alert("添加成功");location.href="/admin/link"</script>';
        }else{
            DB::rollBack();
            echo '<script>alert("添加失败");location.href="/admin/link/create"</script>';
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
        $link = Link::find($id);
        // 显示模板 加载数据
        return view('Admin.link-edit',['link'=>$link]);
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
        // 接收数据
        $link = Link::find($id);
        $link->name = $request->input('name','');
        $link->url = $request->input('url','');
        $link->text = $request->input('text','');
        $data = $link->save();
        if($data){
            DB::commit();
            return redirect('/admin/link')->with('success','修改成功');
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
       $data = Link::destroy($id);
       if($data){
            return redirect($_SERVER['HTTP_REFERER'])->with('success','删除成功');
       }else{
            return redirect($_SERVER['HTTP_REFERER'])->with('error','删除失败');
       }
    }
}
