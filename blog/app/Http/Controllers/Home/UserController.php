<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\User;
use App\Model\Home\Userinfo;
use DB;
class UserController extends Controller
{
    public static function getUserinfo(){
        
        // $data = DB::table('user_info')->where('user_id',$homeid)->first();
        // return $data->nickname;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $data = DB::table('user_info')->where('phone',$id)->get();
        // $data = DB::table('user_info')->where('phone',$id)->first();
        // if(isset($data)){
             // 加载页面
            return view('Home.information');
  
            // return view('Home.information');
    
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $data = DB::table('user_info')->first();
        // dump($request->session()->get('homeid'));
        // if(isset($data)){
        //      // 加载页面
        //     return view('Home.information',['data'=>$data,'request'=>$request->all()]);
        // }else{
        //     return view('Home.information',['request'=>$request->all()]);
        // }
    }

    public function personal(Request $request){
        $phone = $request->session()->get('homephone');
        return view('Home.personal',['phone'=>$phone]);
    }

    public function update2($id){
        $data = DB::table('user_info')->where('id',$id)->first();
        //var_dump($data);
        // dump($data);

         return view('Home.tanchuan',['data'=>$data]);
    }

    public function update1(Request $request){
        $id = $request->session()->get('homeid');
        $data = $request->except(['_token']);
        $res = DB::table('user_info')
            ->where('user_id', $id)
            ->update(['nickname' => $data['nickname'],'sex'=>$data['sex']]);
        //dump($data);
        if($res){
            return back();
        }else{
            return back();
        }

    }



    public function role(Request $request){
        $dd = $_FILES["file"];
        
        //$dd = $request->all();
        //echo $dd; 
        $path = $request->file('file')->store('portrait');
        $id = $request->session()->get('homeid');
        $data = DB::table('user_info')->select('img')->where('id',$id)->first();
        //unlink('/images/portrait/BcWppimxJBnuAIEheybLGiLUrsY4jZMa5mvumgxk.jpeg'); 
        DB::table('user_info')
            ->where('uid', $id)
            ->update(['img' => $path]);

   
        echo $path;    
        //echo '11111'; 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 执行文件上传
        if($request->hasFile('img')){
            $file = $request->file('img');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
           
            $img = $file->storeAs('',$file_name);
           
            
        }

        //接收数据
        $data = $request->except(['_token']);
        //赋值;
        $data['img'] = $img;
        // 获取数据
        $user = new User;
        $res = $request->except('_token');
        $reser = DB::table('user_register')->where('phone','=',$res['phone'])->first();
        $info = new Userinfo;
        $info->user_id = $reser->id;
        $info->img = $data['img'];
        $info->nickname = $data['nickname'];
        $info->realname = $data['realname'];
        $info->phone = $data['phone'];
        $info->sex = $data['sex'];
        $info->email = $data['email'];
        $infos = $info->save();
        if($infos){
            echo '<script>alert("添加成功");location.href="/"</script>';
        }else{
            echo '<script>alert("添加失败");location.href="/"</script>';
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // 加载数据
        $data = DB::table('user_info')->where('phone',$id)->first();
        $phone = $request->session()->get('homephone');
        // if(isset($data)){
        
             // 加载页面
            return view('Home.information',['data'=>$data,'id'=>$id,'phone'=>$phone]);
        
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
