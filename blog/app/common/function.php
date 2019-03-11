<?php 
 //循环查询5条最新的COOKIE历史记录 以goods_id
   /*
    param array $his //COOKIE uri记录
    return sql语句查询的5条数据
   */
 public function findHis($his){    
      $in = array();               //存放goods_id
       if (!empty($his)) {         //浏览记录不为空的情况
         foreach ($his as $v) {    //遍历uri
          $sub = explode('=', $v); //用=号分割uri中的goods_id
          $in[] = $sub[1];         //把goods_id 放入数组
        } 
       }  
        $in = implode(',', $in);   //把数组用逗号分割 能用in型代入sql
       //print_r($in);
       //拼接sql
       $sql = 'select goods_id,goods_name,shop_price,thumb_img,market_price from ' .
              $this->table . ' where goods_id in (' . $in . ') order by add_time limit 5';
       return $this->db->getAll($sql);
      } 


 ?>