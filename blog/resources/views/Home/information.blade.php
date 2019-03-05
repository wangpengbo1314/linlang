<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>个人资料</title>

		<link href="/Home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Home/css/infstyle.css" rel="stylesheet" type="text/css">
		<script src="/Home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/Home/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
		<link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
		<meta name="csrf-token" content="{{ csrf_token() }}">
			
	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
									<a href="/" target="_top" class="h"></a>
									&nbsp;&nbsp;|&nbsp;&nbsp;
									<a href="/home/logout" target="_top">退出登录</a>
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/home/user/personal" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/shop/index" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="/Home/images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>


						<!--头像 -->
					<div class="info-main">
						@if(!empty($data))

						
						
						<div class="user-infoPic">
							
							<div class="filePic">
								<!-- <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" name="img"> -->
								<img class="am-circle am-img-thumbnail" src="/images/{{ $data->img }}" alt="" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i>{{ $data->nickname }}</i></b></div>

								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
									</a>
								</div>
								<div class="u-safety">
									<input type="submit" value="修改个人资料" style="background: red;" class="am-btn am-btn-danger" onclick="show({{$data->id}})">
								</div>
							</div>
						</div>

						<!--个人信息 -->
						<form class="am-form am-form-horizontal" action="/home/user" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<div class="am-form-group">
									<div style="width: 100px;height: 50px;float:left;">
										<label for="user-name2" class="am-form-label">昵称</label>
									</div>
									<div style="float:left;">
										<label for="user-name2" class="am-form-label">{{ $data->nickname }}</label>
									</div>
								</div>

								<div class="am-form-group">
									<div style="width: 100px;height: 50px;float:left;">
										<label for="user-name2" class="am-form-label">姓名</label>
									</div>
									<div style="float:left;">
										<label for="user-name2" class="am-form-label">{{ $data->realname }}</label>
									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										@if($data->sex == 1 ? 'checked' : '')
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="1" data-am-ucheck> 男
										</label>
										@elseif($data->sex == 0 ? 'checked' : 'data-am-ucheck')
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="0" data-am-ucheck> 女
										</label>
										@elseif($data->sex == 2 ? 'checked' : 'data-am-ucheck')
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="2" data-am-ucheck> 保密
										</label>
										@endif
									</div>
								</div>
								<div class="am-form-group">
									<div style="width: 100px;height: 50px;float:left;">
										<label for="user-name2" class="am-form-label">手机号</label>
									</div>
									<div style="float:left;">
										<label for="user-name2" class="am-form-label">{{ $data->phone }}</label>
									</div>
								</div>
								<div class="am-form-group">
									<div style="width: 100px;height: 50px;float:left;">
										<label for="user-name2" class="am-form-label">电子邮箱</label>
									</div>
									<div style="float:left;">
										<label for="user-name2" class="am-form-label">{{ $data->email }}</label>
									</div>
								</div>
								
							</form>
							
							@else
							<form class="am-form am-form-horizontal" action="/home/user" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
						<div class="user-infoPic">
							
							<div class="filePic">
								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" name="img">
								<img class="am-circle am-img-thumbnail" src="/Home/images/getAvatar.do.jpg"" alt="" />
							</div>

							<p class="am-form-help">头像</p>

							<div class="info-m">
								<div><b>用户名：<i></i></b></div>
								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
									</a>
								</div>
							</div>
						</div>

						<!--个人信息 -->
						
								
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" name="nickname" placeholder="nickname" value="">

									</div>
								</div>

								<div class="am-form-group">
									<label for="user-name" class="am-form-label">姓名</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" name="realname" placeholder="name" value="">

									</div>
								</div>

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="1" data-am-ucheck> 男
										</label>
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="0" data-am-ucheck> 女
										</label>
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="2" data-am-ucheck> 保密
										</label>
									
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone" name="phone" placeholder="phone" type="tel" value="{{ $phone }}">

									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" name="email" placeholder="Email" type="email" value="">

									</div>
								</div>
								<div class="info-btn">
									<input type="submit" value="保存修改" style="background: red;" class="am-btn am-btn-danger">
								</div>
								
								
								
							</form>

							@endif
						</div>

					</div>

				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="index.html">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li class="active"> <a href="/home/user/{{$phone}}">个人信息</a></li>
							<li> <a href="/home/safety/index">安全设置</a></li>
							<li> <a href="/home/address">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="order.html">订单管理</a></li>
							<li> <a href="change.html">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="coupon.html">优惠券 </a></li>
							<li> <a href="bonus.html">红包</a></li>
							<li> <a href="bill.html">账单明细</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="collection.html">收藏</a></li>
							<li> <a href="foot.html">足迹</a></li>
							<li> <a href="comment.html">评价</a></li>
							<li> <a href="news.html">消息</a></li>
						</ul>
					</li>

				</ul>

			</aside>
		</div>

	</body>

</html>
<script type="text/javascript">
	function selectFocus(){
		document.getElementById("shengri1").setAttribute("size","5");
	}
	function selectClick(){
		document.getElementById("shengri1").removeAttribute("size");
		document.getElementById("shengri1").blur();
		this.setAttribute("selected","");
	}
</script>
<script src="/layui-v2.4.5/layui/layui.js"></script>
<script>
//一般直接写在一个js文件中
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;
  
  //layer.msg('Hello World');
});
function show(id){
	  layer.open({
	  type: 2,
	  title: 'layer mobile页',
	  shadeClose: true,
	  shade: 0.8,
	  area: ['500px', '80%'],
	  content: '/home/user/update2/'+id //iframe的url
}); 
}

</script> 

