<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LoginController extends Controller
{
    public function index(Request $request){
        // 登陆页面
        if($request->session()->exists('adminname')){
            $name = $request->session()->get('adminname');
            $role = $request->session()->get('adminrole');
            
            // dump($name);
            return view('Admin.index',['name'=>$name,'role'=>$role]);   
        }else{
            return view('Admin.login');
        }
    }

        public function login(Request $request){
        $res = $request->except('_token');
        // dd($request->getClientIp());
        session(['adminname' => $res['adminName']]);

        $data = DB::table('admin_users')->where('adminName','=',$res['adminName'])->first();
        

        return redirect('/admin/index');
    }

     public function logout(Request $request){
        $request->session()->forget('adminname','adminrole');
        return redirect('/admin/index');
    }
}
