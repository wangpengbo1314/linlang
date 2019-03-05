<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\User;
use App\Model\Home\Userlogin;
use DB;
use Hash;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 登陆页面
        if($request->session()->exists('homephone')){
            $phone = $request->session()->get('homephone');
            // dump($phone);
            return view('Home.index',['phone'=>$phone]);   
        }else{
            return view('Home.login');
        }
        
    }

    public function login(Request $request){
        $res = $request->except('_token');
        // dd($request->getClientIp());
        session(['homephone' => $res['phone']]);

        $data = DB::table('user_register')->where('phone','=',$res['phone'])->first();
        $login = new Userlogin;
        $login->user_id = $data->id;
        $login->login_name = $data->phone;
        $login->login_ip = $request->getClientIp();
        $login->login_time = date('Y-m-d H:i:s',time());
        $log = $login->save();

        return redirect('/');
    }

    public function logout(Request $request){
        $request->session()->forget('homephone','homeid');
        return redirect('/');
    }

    public function list(Request $request){
        $count = $request->input('count',5);
        $search = $request->input('search','');
        $data = User::where('phone','like','%'. $search.'%')->paginate($count);

        $counts = DB::table('user_register')->count();

        // 加载视图
        return view('Admin.register-list',['data'=>$data,'request'=>$request->all(),'counts'=>$counts]);
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
    public function edit(Request $request,$id)
    {
       /* $phone = $request->session()->get('homephone');
        $data = User::find($id);
        // 加载视图
        return view('Home.password',['data'=>$data,'phone'=>$phone]);*/
    }

    public function pass(Request $request){
        $phone = $request->session()->get('homephone');
        // $data = User::find($id);
        // 加载视图
        return view('Home.password',['phone'=>$phone]);
    }

    public function dataword(Request $request){
        $this->validate($request, [
            'password' => 'required|regex:/^[\w]{8,16}$/',
            'repassword' => 'required|same:password'
        ],[
            'password.required'=>'密码必填',
            'password.regex'=>'密码格式不对',
            'repassword.required'=>'确认密码必填',
            'repassword.smae'=>'俩次密码不一致'
        ]);
        // 修改密码
        $id = $request->session()->get('homeid');
        $pass = $request->except('_token','_method');
        $register = User::find($id);
        if(Hash::check($pass['pass'],$register['password'])){
            $list = DB::table('user_register')->where('id',$id)->update(['password'=>Hash::make($pass['password'])]);
            if($list){
                    return redirect('/home/register/pass')->with('success', '修改成功');

                }else{
                    return redirect('/home/register/pass')->with('success', '修改失败');
                }
        }else{
            return redirect('/home/register/pass')->with('success', '修改失败,密码不正确');
        }
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
        /*$this->validate($request, [
            'password' => 'required|regex:/^[\w]{8,16}$/',
            'repassword' => 'required|same:password'
        ],[
            'password.required'=>'密码必填',
            'password.regex'=>'密码格式不对',
            'repassword.required'=>'确认密码必填',
            'repassword.smae'=>'俩次密码不一致'
        ]);
        // 修改密码
        $pass = $request->except('_token','_method');
        $register = User::find($id);
        if(Hash::check($pass['pass'],$register['password'])){
            $list = DB::table('user_register')->where('id',$id)->update(['password'=>Hash::make($pass['password'])]);
            if($list){
                    return redirect('/home/register/{{$register->id}}/edit')->with('success', '修改成功');

                }else{
                    return redirect('/home/register/{{$register->id}}/edit')->with('success', '修改失败');
                }
        }else{
            return redirect('/home/register/{{$register->id}}/edit')->with('success', '修改失败');
        }*/
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(pass$id)
    {
        //
    }

}
