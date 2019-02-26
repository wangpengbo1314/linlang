<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use App\Http\Requests\UsersStoreRequest;
class UsersStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

   /**
     * 存放 验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            'adminName' => 'required|regex:/^[a-zA-Z]{1}[\w]{7,15}$/',
            'password' => 'required|regex:/^[\w]{6,18}$/',
            'repassword' => 'required|same:password',
            'sex' => 'required|sex',
            'email' => 'required|email',
            'adminRole' => 'required|adminRole',
            'phone' => 'required|regex:/^1{1}[3-9]{1}[\d]{9}$/',
            'text' => 'required',
        ];
    }
    // 自定义错误信息
    public function messages()
    {
        return [
            'adminName.required'=>'用户名必填',
            'adminName.regex'=>'用户名格式不正确',
            'password.regex'=>'密码格式不正确',
            'password.required'=>'密码必填',
            'repassword.required'=>'确认密码必填',
            'repassword.same'=>'俩次密码不一致',
            'sex.required'=>'性别必填',
            'email.required'=>'邮箱必填',
            'email.email'=>'邮箱格式不正确',
            'phone.required'=>'手机号必填',
            'phone.regex'=>'手机号格式不正确',
        ];
    }
}
