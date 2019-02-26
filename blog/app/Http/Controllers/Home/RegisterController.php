<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\User;
use DB;
use Hash;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 登陆页面
        return view('Home.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载视图
        return view('Home.register');
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
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'password' => 'required|regex:/^[\w]{8,16}$/',
            'repassword' => 'required|same:password'
        ],[
            'phone.required'=>'手机号必填',
            'phone.regex'=>'手机号格式不对',
            'password.required'=>'密码必填',
            'password.regex'=>'密码格式不对',
            'repassword.required'=>'确认密码必填',
            'repassword.smae'=>'俩次密码不一致'
        ]);
        // 接收数据
        // dd($data = $request->all());
        $data = $request->except('_token');
        $user = new User;
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $res = $user->save();
        if($res){
            
            return redirect('/home/register')->with('success','添加成功');
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
        //
    }
}
