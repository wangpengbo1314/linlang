<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Hash;
class RegisterMiddleware
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
        $register = DB::table('user_register')->where('phone','=',$data['phone'])->first();
        // dd($register);
       if($register && $data['phone'] == $register->phone && Hash::check($data['password'],$register->password)){
        session(['homeid'=> $register->id]);
        return $next($request);
       }
        return redirect('/')->with('error','用户或密码不正确');
    }
}
