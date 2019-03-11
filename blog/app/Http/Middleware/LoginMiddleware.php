<?php

namespace App\Http\Middleware;
use DB;
use Closure;
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
            $login_info = DB::table('admin_users')->whewe('adminName',$data['adminName'])->first();
        //验证登录
        if ($login_info && $data['adminName'] == $login_info->adminName && Hash::check($data['password'] == $login_info->password)) {
            //执行下一次 通过
             return $next($request);
        }else{
          
             return redirect('/admin/login')->with('error','用户名或密码不正确');
        }
      
    }
}
