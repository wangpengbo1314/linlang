<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\User;
use App\Model\Home\Address;
use DB;
class AddressController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $phone = $request->session()->get('homephone');
       $homeid = $request->session()->get('homeid');
        $add = DB::table('goods_address')->where('user_id',$homeid)->get();
        
        // 加载视图
        return view('Home.address',['add'=>$add,'phone'=>$phone]);
    }

    public function list(Request $request){
        $uid = $request->input('uid');
        $id = $request->input('id');
        $data = DB::table('goods_address')->where('user_id',$uid)->update(['status'=>1]);

        // echo $data;
        $res = DB::table('goods_address')->where('id',$id)->update(['status'=>0]);
        // echo $res;

        $address = DB::table('goods_address')->where('status',0)->where('user_id',$uid)->first();
        echo json_encode($address);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('Home.safety');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'cmbCity' => 'required',
            'cmbProvince' => 'required',
            'cmbArea' => 'required',
            'address' => 'required'
        ],[
            'name.required'=>'收货人必填',
            'phone.required'=>'手机号必填',
            'phone.regex'=>'手机号格式不对',
            'address.required'=>'详情地址必填',
            'cmbProvince.required'=>'省地址必填',
            'cmbArea.required'=>'县区地址必填',
            'cmbCity.required'=>'市地址必填'
        ]);
        //接收数据
        $data = $request->except(['_token']);
        $homeid = $request->session()->get('homeid');
        $address = new Address;
        $address->user_id = $homeid;
        $address->name = $data['name'];
        $address->phone = $data['phone'];
        $address->status = $data['status'];
        $address->cmbProvince = $data['cmbProvince'];
        $address->cmbCity = $data['cmbCity'];
        $address->cmbArea = $data['cmbArea'];
        $address->cmdAddress = $data['address'];
        $add = $address->save();
        if($add){
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
        $delete = Address::destroy($id);
        if($delete){
            return redirect('/home/address')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
