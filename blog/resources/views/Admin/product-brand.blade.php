<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--[if lt IE 9]>
<script type="text/javascript" src="/Admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>品牌管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20">  <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<div class="mt-20">
		@foreach($order as $k=>$v)
		<table class="table table-bordered">
			<thead>
				<tr class="text-c">
					<th>ID</th>
					<th>商品名称</th>
					<th>商品价格</th>
					<th>商品数量</th>
					<th>商品图片</th>
					<th>订单编号</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<tr class="text-c">
					<td>{{$v->id}}</td>
					<td>{{$v->name}}</td>
					<td>{{$v->price}}</td>
					<td>{{$v->number}}</td>
					<td><img src="/images/{{$v->img}}"  width="80" height="80"></td>
					<td>{{$v->rand}}</td>
					@if($v->status == 0)
					<td class="btn btn-info" style="margin-top: 30px;" onclick="fa({{$v->id}})">确认发货</td>
					@else
					<td class="btn btn-info" style="margin-top: 30px;">已发货</td>
					@endif
				</tr>
			</tbody>
		</table>
		@endforeach
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Admin/lib/laypage/1.2/laypage.js"></script>

</body>
</html>
<script type="text/javascript">
	function fa(id){
		$.ajax({
			headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
			type:'post',
			url:'/admin/order/show',
			data:{'id':id},
			dataType: 'json',
			success:function(data){
				console.log(data);
				
			}
		});
	}
</script>