<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsStoreRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             //验证数据
       
        'goods_home' => 'required',
        'goods_name' => 'required',
        'goods_sales' => 'required',
        'goods_price' => 'required',
        'goods_pic' => 'required',
      
        
        
        ];
    }
    public function messages(){
         return [
        'goods_home.required'=>'商品标题必填',
       
        'goods_name.required'=>'商品名称必填',
        'goods_price.required'=>'商品价格必填',
        'goods_sales.required'=>'商品描述必填',
        'goods_pic.required'=>'商品图片必选',
        
        ];
    }
}
