<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取数据
        $user = DB::table('user_register')->get();
        $users = User::find(2);
        dump($users->phone);
        $id = $users->userinfo->user_id;
        $res = DB::table('user_info')->where('id','=',$id)->get();

        // $res = Userinfo::find($data->user_id);
        
        return view('Home.information',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载视图
        return view('Home.information');
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
        // 获取数据
        $res = $request->except('_token');
        // dd($data);
        $user = new Userinfo;
        $user->nickname = $res['nickname'];
        $user->realname = $res['realname'];
        $user->sex = $res['sex'];
        $user->phone = $res['phone'];
        $user->birthday = $res['birthday'];
        $user->email = $res['email'];
        $data = $user->save();
        if($data){
            DB::commit();
            echo '<script>alert("添加成功");location.href="home/user"</script>';
        }else{
            DB::rollBack();
            echo '<script>alert("添加失败");location.href="home/user/create"</script>';
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
        //
    }
}
