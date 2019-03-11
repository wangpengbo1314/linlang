<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->exists('adminName')) {
            $adminName = $request->session()->get('adminName');
            return view('Admin.index',['session_value'=>$session_value]);
        }else{

             // session(['adminName' => 'admin']);
            return view('Admin.login');
        }  
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
       

    }

    public function login(Request $request){

        //接收数据
          $data = $request->except('_token');
          session(['adminName'=>$data['adminName']]);
          $userinfo = DB::table('admin_users')->where('adminName','=',$data['adminName'])->first();
        $login = new Login;
        $login->adminName = $userinfo->adminName;
        $res = $login->save();
        if ($userinfo) {
           return redirect('admin/index')->with('success','登陆成功');
        }else{
             return back()->with('success','登陆失败');
        }
      
}

    public function outlogin(Request $request){
         $request->session()->forget('adminName');
        return redirect('/');
    }
}
