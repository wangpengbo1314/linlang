<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>地址管理</title>

		<link href="/Home/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/Home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/Home/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/Home/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="/Home/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="/Home/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/Home/js/city.js"></script>
		<script type="text/javascript" src="/Home/js/addresss.js"></script>
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
									<a href="#" target="_top" class="h">亲，请登录</a>
									<a href="#" target="_top">免费注册</a>
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

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
							@foreach($add as $k=>$v)
							@if($v->status == 0)
							<li class="user-addresslist defaultAddr" id="address" onclick="fan({{$v->status}},{{$v->user_id}},{{ $v->id }})">
								<span class="new-option-r"><!-- <i class="am-icon-check-circle"></i> -->默认地址</span>
								<p class="new-tit new-p-re">
									<span class="new-txt">{{ $v->name }}</span>
									<span class="new-txt-rd2">{{ $v->phone }}</span>
								</p>
								<div class="new-mu_l2cw new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province">{{ $v->cmbProvince }}</span>省
										<span class="city">{{ $v->cmbCity }}</span>
										<span class="dist">{{ $v->cmbArea }}</span>
										<span class="street">{{ $v->cmbAddress }}</span></p>
								</div>
								<div class="new-addr-btn">
									<a href="#"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<form action="/home/address/{{ $v->id }}" method="post" style="float:right">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
									<a href="javascript:void(0);" onClick="delClick(this);"><i class="am-icon-trash"></i><input type="submit" value="删除" style="border:none;background-color: white;outline:none;" onclick="return confirm('确认要删除吗?')"></a>
									</form>
								</div>
							</li>
							@else
							<li class="user-addresslist" id="address" onclick="fan({{$v->status}},{{ $v->user_id }},{{$v->id}})">
								<span class="new-option-r"><!-- <i class="am-icon-check-circle"></i> -->默认地址</span>
								<p class="new-tit new-p-re">
									<span class="new-txt">{{ $v->name }}</span>
									<span class="new-txt-rd2">{{ $v->phone }}</span>
								</p>
								<div class="new-mu_l2cw new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province">{{ $v->cmbProvince }}</span>省
										<span class="city">{{ $v->cmbCity }}</span>
										<span class="dist">{{ $v->cmbArea }}</span>
										<span class="street">{{ $v->cmbAddress }}</span></p>
								</div>
								<div class="new-addr-btn">
									<a href="#"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<form action="/home/address/{{ $v->id }}" method="post" style="float:right">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
									<a href="javascript:void(0);" onClick="delClick(this);"><i class="am-icon-trash"></i><input type="submit" value="删除" style="border:none;background-color: white;outline:none;" onclick="return confirm('确认要删除吗?')"></a>
									</form>
								</div>
							</li>
							@endif
							
							@endforeach
						</ul>
						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<!-- 显示错误处理 -->
		@if (count($errors) > 0)
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif
									<form class="am-form am-form-horizontal" action="/home/address" method="post">
										{{ csrf_field() }}
										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" id="user-name" placeholder="收货人" name="name" value="{{ old('name') }}">
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" placeholder="手机号必填" type="text" name="phone" value="{{ old('phone') }}">
											</div>
										</div>
										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">默认地址状态</label>
												<select data-am-selected name="status">
													<option value="0">默认</option>
													<option value="1">不默认</option>
												</select>
										</div>
										<div class="am-form-group">
											<label for="user-address" class="am-form-label">所在地</label>
											<div class="am-form-content address">
												<!-- <select name="province" id="province" onchange="selectCityByPid()"></select>
												<select name="city" id="city"></select> -->
<select id="cmbProvince" name="cmbProvince" value="{{ old('cmbProvince') }}"></select>  
<select id="cmbCity" name="cmbCity" value="{{ old('cmbCity') }}"></select>  
<select id="cmbArea" name="cmbArea" value="{{ old('cmbArea') }}"></select>  
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-intro" class="am-form-label">详细地址</label>
											<div class="am-form-content">
												<textarea class="" rows="3" id="user-intro" placeholder="输入详细地址" name="address" value="">{{ old('address') }}</textarea>
												<small>100字以内写出你的详细地址...</small>
											</div>
										</div>
										
										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<input type="submit" value="提交" class="am-btn am-btn-danger">
												<input type="reset" value="重置" class="am-close am-btn am-btn-danger">

											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>

					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

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
						<a href="/home/user/personal">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li> <a href="/home/user/{{ $phone }}">个人信息</a></li>
							<li> <a href="/home/safety/index">安全设置</a></li>
							<li class="active"> <a href="/home/address">收货地址</a></li>
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
addressInit('cmbProvince', 'cmbCity', 'cmbArea');  
</script>
<script type="text/javascript">
	// var ress = document.getElementById('address');
	function fan(status,uid,id){
		
		$.ajax({
			headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
			type:'post',
			url:'/home/address/list',
			data:{'uid':uid,'id':id},
			dataType: 'json',
			success:function(data){
				/*if(res == 0){
					$('#address').className('user-addresslist defaultAddr');
				}else{
					$('#address').className('user-addresslist');
				}*/
				console.log(data);
			}
		});
	}
</script>