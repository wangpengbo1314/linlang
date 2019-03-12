<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>结算页面</title>

		<link href="/Home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />

		<link href="/Home/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/Home/css/cartstyle.css" rel="stylesheet" type="text/css" />

		<link href="/Home/css/jsstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/Home/js/address.js"></script>
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
	</head>

	<body>

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
					<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="/home/user/personal" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="/home/shop/index" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
				</div>
				<div class="topMessage favorite">
					<div class="menu-hd"><a href="/home/collection/list" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
			</ul>
			</div>

			<!--悬浮搜索框-->

			<div class="nav white">
				<div class="logo"><img src="/Home/images/logo.png" /></div>
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
			<div class="concent">
				
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
							<div class="am-btn am-btn-danger"><a href="/home/address" style="color: white;">使用新地址</a></div>
						</div>
						
						<div class="clear"></div>
						
						<ul>
						@foreach($address as $k=>$v)
						@if($v->status == 0)
							<div class="per-border"></div>
							<li class="user-addresslist defaultAddr">

								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   						<span class="buy-user">{{$v->name}} </span>
										<span class="buy-phone">{{$v->phone}}</span>
										</span>

									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   		<span class="province" id="cmbProvince">{{$v->cmbProvince}}</span>省
										<span class="city">{{$v->cmbCity}}</span>
										<span class="dist">{{$v->cmbArea}}</span>
										<span class="street">{{$v->cmbAddress}}</span>
										</span>

										</span>
									</div>
									<ins class="deftip">默认地址</ins>
								</div>
								<div class="address-right">
									<a href="person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="#" onclick="fan({{$v->status}},{{$v->user_id}},{{ $v->id }})">设为默认</a>
									<span class="new-addr-bar">|</span>
									<a href="#">编辑</a>
									<span class="new-addr-bar">|</span>
									<form action="/home/address/{{ $v->id }}" method="post" style="float:right">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
									<a href="javascript:void(0);" onclick="delClick(this);"><input type="submit" value="删除" style="border:none;background-color: white;outline:none;font-size: 14px;" onclick="return confirm('确认要删除吗?')"></a>
									</form>
								</div>

							</li>
							
						@else
						<div class="per-border"></div>
							<li class="user-addresslist">

								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   						<span class="buy-user">{{$v->name}} </span>
										<span class="buy-phone">{{$v->phone}}</span>
										</span>

									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   		<span class="province" id="cmbProvince">{{$v->cmbProvince}}</span>省
										<span class="city">{{$v->cmbCity}}</span>
										<span class="dist">{{$v->cmbArea}}</span>
										<span class="street">{{$v->cmbAddress}}</span>
										</span>

										</span>
									</div>
									<ins class="deftip">默认地址</ins>
								</div>
								<div class="address-right">
									<a href="person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									<a href="#" onclick="fan({{$v->status}},{{$v->user_id}},{{ $v->id }})">设为默认</a>
									<span class="new-addr-bar">|</span>
									<a href="#">编辑</a>
									<span class="new-addr-bar">|</span>
									<form action="/home/address/{{ $v->id }}" method="post" style="float:right">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
									<a href="javascript:void(0);" onclick="delClick(this);"><input type="submit" value="删除" style="border:none;background-color: white;outline:none;font-size: 14px;" onclick="return confirm('确认要删除吗?')"></a>
									</form>
								</div>

							</li>
						@endif
						@endforeach
						</ul>

						<div class="clear"></div>
					</div>
					<!--支付方式-->
					<div class="logistics">
						<h3>选择支付方式</h3>
						<ul class="pay-list">
							<li class="pay qq"><img src="/Home/images/weizhifu.jpg" />微信<span></span></li>
							<li class="pay taobao"><img src="/Home/images/zhifubao.jpg" />支付宝<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-amount">
										<div class="td-inner">数量</div>
									</div>
									<div class="th th-sum">
										<div class="td-inner">金额</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>
							<!-- {{ $table = 0 }} -->
							@foreach($cart as $k=>$v)
							<tr id="J_BundleList_s_1911116345_1" class="item-list">
								<div id="J_Bundle_s_1911116345_1_0" class="bundle  bundle-last">
									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="/images/{{$v->pic}}" class="itempic J_ItemImg" width="80" height="80"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" target="_blank" title="{{$v->name}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->name}}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">样式：原味</span>
														<span class="sku-line">包装：普通装</span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->price}}</em>
														</div>
													</div>
												</li>
											</div>

											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<div class="sl">
															<a href="/home/shop/jian/{{$v->id}}">
															<input class="min am-btn" name="" type="button" value="-" /></a>
															<input class="text_box" name="" type="text" value="{{$v->number}}" style="width:30px;" />
															<a href="/home/shop/jia/{{$v->id}}">
															<input class="add am-btn" name="" type="button" value="+" /></a>
														</div>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<!-- {{ $table += $v->price * $v->number}} -->
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{ $v->price * $v->number }}</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														包邮
													</div>
												</div>
											</li>

										</ul>
										<div class="clear"></div>

									</div>
							</tr>
							@endforeach
							</div>
							<div class="clear"></div>
							<div class="pay-total">
						<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>
							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">{{$table}}</em>
								</p>
							</div>

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{$table}}</em>
											</span>
										</div>
										<div id="holyshit268" class="pay-address">

											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="buy--address-detail">
								   				<span class="province" id="cmbProvince">{{$res->cmbProvince}}</span>省
												<span class="city" id="cmbCity">{{$res->cmbCity}}</span>
												<span class="dist" id="cmbArea">{{$res->cmbArea}}</span>
												<span class="street" id="cmbAddress">{{$res->cmbAddress}}</span>
												</span>
												</span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">   
                                         		<span class="buy-user" id="name">{{$res->name}}</span>
												<span class="buy-phone" id="phone">{{$res->phone}}</span>
												</span>
											</p>
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a id="J_Go" href="/home/pay/list/{{$table}}" class="btn-go" tabindex="0" title="点击此按钮，提交订单" >提交订单</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
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
			<div class="theme-popover-mask"></div>

			<div class="clear"></div>
	</body>

</html>
<script type="text/javascript">
	function fan(status,uid,id){
		
		$.ajax({
			headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
			type:'post',
			url:'/home/address/list',
			data:{'uid':uid,'id':id},
			dataType: 'json',
			success:function(address){
				console.log(address);
				$("#name").text(address.name);
				$("#phone").text(address.phone);
				$("#cmbProvince").text(address.cmbProvince);
				$("#cmbCity").text(address.cmbCity);
				$("#cmbArea").text(address.cmbArea);
				$("#cmbAddress").text(address.cmbAddress);
				
			}
		});
	}
</script>
<script type="text/javascript">
	function order(table){
		$.ajax({
			headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
			type:'post',
			url:'/home/pay/show',
			data:{'table':table},
			dataType: 'json',
			success:function(address){
				console.log(address);
				
			}
		});
	}
</script>