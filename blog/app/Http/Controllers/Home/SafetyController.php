<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use Cookie;
use App\Model\Home\User;
class SafetyController extends Controller
{

    public function index(Request $request){
    	$phone = $request->session()->get('homephone');
    	$id = $request->session()->get('homeid');
    	$data = DB::table('user_info')->where('phone',$phone)->first();
    	return view('Home.safety',['phone'=>$phone,'data'=>$data,'id'=>$id]);
    }

    public function email(Request $request){
    	$phone = $request->session()->get('homephone');
    	return view('Home.email',['phone'=>$phone]);
    }

    public function show(Request $request){
    	$email = $request->input('email');
    	$str = trim($email);
    	$title = rand(1000,9999);
    	Cookie::queue('email',$title,5);
    	// 发送邮箱
    	Mail::send('Home.emails', ['title' => $title], function ($m) use ($str) {

            $m->to($str)->subject('【琳琅商城】');
        });
        // echo $email;
    }

    public function list(Request $request){
    	$cookie = Cookie::get('email');
    	$data = $request->except('_token');
    	// $this->validate($request, [
    	// 	'email' => 'required|email',
    	// 	'yan' => 'required|res:'.$cookie,
    	// ],[
    	// 	'email.required' => '邮箱必填',
    	// 	'email.email' => '邮箱格式不对',
    	// 	'yan.required' => '验证码没有填写',
    	// 	'yan.res' => '验证码不正确'
    	// ]);
    	if($cookie == $data['yan']){
    		// dump($request->input('email'));
    		$id = $request->session()->get('homeid');
    		$ass = DB::table('user_register')->select('email','phone')->where('id',$id)->first();
    		// dd($ass);
    		if($ass->email == null && $ass->phone == null){
    			$res = DB::table('user_register')->insert(['email'=>$data['email']]);
    			if($res){
    				return redirect('/home/safety/email')->with('success', '添加成功');

    			}else{
    				return redirect('/home/safety/email')->with('success', '添加失败');
    			}
    		}else{
    			$list = DB::table('user_register')->where('id',$id)->update(['email'=>$data['email']]);
    			if($list){
    				return redirect('/home/safety/email')->with('success', '修改成功');

    			}else{
    				return redirect('/home/safety/email')->with('success', '已验证,修改失败');
    			}
    		}
    		
    	}else{
    		return back()->with('error','验证码不正确');
    	}
    	
    }
}
