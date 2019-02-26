<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/fenye.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="/home/banner" method="get">
	<div class="text-c">
		<label>显示
			      <select size="1" name="count" aria-controls="DataTables_Table_1">
			        <option value="5"  @if(isset($request['count']) && $request['count'] == 5) selected @endif>5</option>
			        <option value="10" @if(isset($request['count']) && $request['count'] == 10) selected @endif>10</option>
			        <option value="15" @if(isset($request['count']) && $request['count'] == 15) selected @endif>15</option>
			        <option value="50" @if(isset($request['count']) && $request['count'] == 50) selected @endif>50</option>
			    </select>条</label>				
		<input type="text" name="search" id="" placeholder=" 图片名称" style="width:250px" class="input-text" value="{{ $request['search'] or '' }}">
		<input class="btn btn-success" type="submit" value="搜索"><!-- <i class="Hui-iconfont">&#xe665;</i> --></input>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="picture_add('添加图片','picture-add.html')" href="/home/banner/create"><i class="Hui-iconfont">&#xe600;</i> 添加图片</a></span> <span class="r">共有数据：<strong>{{ $counts }}</strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th><input name="" type="checkbox" value=""></th>
					<th>ID</th>
					<th>图片名称</th>
					<th>轮播图片</th>
					<th>更新时间</th>
					<th>发布状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $k=>$v)
				<tr class="text-c">
					<td><input name="" type="checkbox" value=""></td>
					<td>{{ $v->id }}</td>
					<td>{{ $v->name }}</td>
					<td><img src="/images/{{ $v->img }}" width="100" height="100"></td>
					<td>{{ $v->created_at }}</td>
					<td class="td-status"><!-- <span class="label label-success radius"> -->
						{!! $v->status == 1 ? '<span class="label label-success radius">已发布</span>' : '<span class="label label-defaunt radius">已下架</span>' !!}
						<!-- @if($v->status == 1)
						已发布
						@else($v->status == 2)
						已下架
						@endif -->
					<!-- </span> --></td>
					<td class="td-manage">
						<!-- <a style="text-decoration:none" onClick="picture_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>  -->
						<a style="text-decoration:none" class="ml-5" onClick="picture_edit('图库编辑','picture-add.html','10001')" href="/home/banner/{{ $v->id }}/edit" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
						<form action="/home/banner/{{ $v->id }}" method="post" style="display: inline-block;">
                		{{ csrf_field() }}
                		{{ method_field('DELETE') }}
                		<i ><input type="submit" class="Hui-iconfont" value="&#xe6e2;"></i>
                		<!-- <a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'10001')" href="/home/banner/{{ $v->id }}" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a> -->
                		</form>
					</td>	
				</tr>
				@endforeach
			</tbody>
		</table>
		<div id="fenye" class="bs-example">
			<nav aria-label="Page navigation">
			{{ $data->appends($request)->links() }}
			</nav>
		</div>
		
		<!-- <div >
     	{{ $data->appends($request)->links() }}
     </div> -->
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
<script type="text/javascript">
/*$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
	]
});*/

/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-查看*/
function picture_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-审核*/
function picture_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过'], 
		shade: false
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}

/*图片-下架*/
function picture_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*图片-发布*/
function picture_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}

/*图片-申请上线*/
function picture_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*图片-删除*/
function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script>
</body>
</html>