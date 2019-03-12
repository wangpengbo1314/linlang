<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Hash;
use App\Model\Admin\Users;
class UserController extends Controller
{

    public function index(Request $request){
    	return view('Admin.admin-add');
    }

    // 接收数据
    public function show(Request $request){
    	$res = $request->except('_token');
    	$data = new Users;
    	$data->adminName = $res['adminName'];
    	$data->password = Hash::make($res['password']);
    	$data->sex = $res['sex'];
    	$data->phone = $res['phone'];
    	$data->adminRole = $res['adminRole'];
        $data->email = $res['email'];
    	$data->text = $res['text'];
    	$date = $data->save();
    	if($date){
    		echo '<script>alert("添加成功");location.href="/admin/user/list"</script>';
    	}else{
    		echo '<script>alert("添加失败");location.href="/admin/user/index"</script>';
    	}
        // return back();
    }

    public function list(Request $request){
        $role = $request->session()->get('adminrole');
        $count = $request->input('count',5);
        $search = $request->input('search','');
        $data = Users::where('adminName','like','%'. $search.'%')->paginate($count);
    	// 获取数据
    	// $res = DB::table('admin_users')->get();
        $counts = DB::table('admin_users')->count();
    	return view('Admin.admin-list',['data'=>$data,'count'=>$count,'request'=>$request->all(),'counts'=>$counts,'role'=>$role]);
    }

    // 修改数据
    public function update($id){
        // $res = Users::find($id);
        $res = DB::table('admin_users')->where('id','=',$id)->get();
        // dd($res);
        return view('Admin.admin-edit',['res'=>$res]);
    }

    // 修改数据成功页面
    public function edit(Request $request,$id){
       /* $res = $request->except('_token');
        //dd($res);
        $data = Users::find($res['id']);
        //dd($data);
        $data->adminName = $res['adminName'];
        $data->password = $res['password'];
        $data->sex = $res['sex'];
        $data->phone = $res['phone'];
        $data->adminRole = $res['adminRole'];
        $data->email = $res['email'];
        $data->text = $res['text'];
        $date = $data->save();
        if($date){
            echo '<script>alert("修改成功");location.href="/admin/user/list"</script>';
        }else{
            return redirect('admin/user/update');
        }*/
        DB::beginTransaction();
        $user = Users::find($id);
        $user->email = $request->input('email','');
        $user->phone = $request->input('phone','');
        $user->text = $request->input('text','');
        $res1 = $user->save();
        if($res1){
            DB::commit();
            return redirect('/admin/user/list')->with('success','修改成功');
        }else{
            DB::rollBack();
            return back()->with('error','修改失败');
        }
    }

    // 删除数据
    public function delete($id){

        // $id = DB::table('admin_users')->where('id',$id)->get();
        // dd($id);
        $res = Users::destroy($id);
        // dd($res);
        // if($res){
        //     DB::commit();
        //     return redirect($_SERVER['HTTP_REFERER'])->with('success','删除成功');
        // }else{
        //     DB::rollBack();
        //     return redirect($_SERVER['HTTP_REFERER'])->with('error','删除失败');
        // }
        if($res){
            echo '<script>alert("删除成功");location.href="/admin/user/list"</script>';
        }else{
            echo '<script>alert("删除失败");location.href="/admin/user/list"</script>';
        }
        
    }

    // 权限管理
    public function permission(){
        return view('Admin.admin-permission');
    }

    // 角色管理
    public function role(){
        return view('Admin.admin-role');
    }
}
