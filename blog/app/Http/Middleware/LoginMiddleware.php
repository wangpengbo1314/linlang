<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Hash;
class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $request->except('_token');
        // dd($data);
        $login = DB::table('admin_users')->where('adminName','=',$data['adminName'])->first();
        // dd($login->password);
       if($login && $data['adminName'] == $login->adminName && Hash::check($data['password'],$login->password)){
        session(['adminrole'=> $login->adminRole]);
        session(['adminid'=> $login->id]);
        return $next($request);
       }
       // dd(2);
        return redirect('/admin/index')->with('error','用户或密码不正确');
    }
}
