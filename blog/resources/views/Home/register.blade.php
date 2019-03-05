<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/Home/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
		<link href="/Home/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/Home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/Home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	</head>

	<body>

		<div class="login-boxtitle">
			<a href="home/demo.html"><img alt="" src="/Home/images/logobig.png" /></a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="/Home/images/big.jpg" /></div>
				<div class="login-box">

				<div class="am-tabs" id="doc-my-tabs">
						<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
							<li><a href="">手机号注册</a></li>
						</ul>

		<div class="am-tab-panel">
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
			<form action="/home/register" method="post">
					{{ csrf_field() }}
                 <div class="user-phone">
					<label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
					<input type="tel" name="phone" id="phone" placeholder="请输入手机号" value="{{ old('phone') }}">
                 </div>	
                 <div class="user-pass">
					<label for="password"><i class="am-icon-lock"></i></label>
					<input type="password" name="password" id="password" placeholder="设置密码/最少8位,最多16位" value="{{ old('password') }}">
                 </div>										
                 <div class="user-pass">
					<label for="repassword"><i class="am-icon-lock"></i></label>
					<input type="password" name="repassword" id="repassword" placeholder="确认密码" value="{{ old('repassword') }}">
                 </div>	
									
				<div class="am-cf">
				<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
				</div>
								
				<hr>
				</div>
			</form>
				<script>
					$(function() {
					$('#doc-my-tabs').tabs();
				})；
				</script>
				</div>
			</div>
		</div>
	</div>
			
					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有</em>
							</p>
						</div>
					</div>
	</body>

</html>