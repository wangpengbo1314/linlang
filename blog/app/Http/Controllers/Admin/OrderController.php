<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Order;
use App\Model\Admin\Goods;
use App\Model\Admin\User;
use DB;
class OrderController extends Controller
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
        $data = Order::where('guid','like','%'.$search.'%')->paginate($count);
        return view('Admin.order-list',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.order-add');
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
        $data = $request->all();
        $order = new Order;
        $order->guid = time()+mt_rand(1000,999999);
        $order->cargo_message = $data['cargo_message'];
        $order->address_message = $data['address_message'];
        $order->pay_transaction = $data['pay_transaction'];
        $order->pay_type = $data['pay_type'];
        $order->pay_status = $data['pay_status'];
        $order->total_amount = $data['total_amount'];
        $res1 = $order->save();
        $goods = new Goods;
        $order->id = $goods->order_id;
        $res2 = $goods->save();
        
        
        if ($res1 && $res2) {
             DB::commit();
             return redirect('admin/order')->with('success','添加成功');
        }else{
            DB::rollBack();
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
         //查询对应的信息
       $order =  Order::find($id);
      
        //显示模板 加载数据
        return view('Admin.product-edit',['order'=>$order]);
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
         DB::beginTransaction();
         $order = Order::find($id);
         // $order->guid = $order->guid;
         $order->cargo_message = $request->input('cargo_message');
         $order->address_message = $request->input('address_message');
         $order->pay_transaction = $request->input('pay_transaction');
         $order->pay_type = $request->input('pay_type');
         $order->pay_status = $request->input('pay_status');
         $order->total_amount = $request->input('total_amount');
         $res1 = $order->save();
          if ($res1) {
             DB::commit();
             return redirect('admin/order')->with('success','修改成功');
        }else{
            DB::rollBack();
             return back()->with('error','修改成功');
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
        $res1 = Order::where('id',$id)->delete();
        if ($res1) {
             DB::commit();
             return redirect('admin/order')->with('success','删除成功');
        }else{
            DB::rollBack();
             return back()->with('error','删除失败');
        }

    }
}
