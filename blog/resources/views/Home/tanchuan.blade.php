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
			<link rel="stylesheet" type="text/css" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		 <link rel="stylesheet" href="/layui-v2.4.5/layui/css/layui.css">
		 <meta name="csrf-token" content="{{ csrf_token() }}">
			
	</head>

	<body>
		<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
		<div class="info-main">
								
						<form class="am-form am-form-horizontal"  method="post" enctype="multipart/form-data" id="uploadImg">
								{{ csrf_field() }}
						<div class="user-infoPic">
							
							<p class="am-form-help">头像</p>
							<div class="filePic">

								<input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" name="file" ">
								<input type="hidden" name="id" value="{{ $data->id }}">
								<img class="am-circle am-img-thumbnail" src="/images/{{ $data->img }}" alt="" />
							</div>

							
							
						</div>
						</form>
						<br>

						<!--个人信息 -->
								
						<form class="am-form am-form-horizontal" action="/home/user/update1" method="post" >
								{{ csrf_field() }}	
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" name="nickname" placeholder="nickname" value="{{$data->nickname}}">

									</div>
								</div>

								

								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="1" data-am-ucheck {{$data->sex == 1 ? 'checked' : ''}}> 男
										</label>
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="0" data-am-ucheck {{$data->sex == 0 ? 'checked' : ''}}> 女
										</label>
										
										<label class="am-radio-inline">
											<input type="radio" name="sex" value="2" data-am-ucheck {{$data->sex == 2 ? 'checked' : ''}}> 保密
										</label>
										
									</div>
								</div>
								<div class="info-btn">
									<input type="submit" value="提交" style="background: red;" class="am-btn am-btn-danger">
								</div>
								
								
								
							</form>
		</div>

	</body>

</html>
<script type="text/javascript">
	
	$(function(){
        $('input[type="file"]').on('change', function(){
            var file = this.files[0];
            var formData = new FormData($('#uploadImg')[0]);
            formData.append('file', file);
            console.log(formData.get('file'))
            $.ajax({
                url: '/home/user/role',
                type: 'POST',
                cache: false,
                data:formData,
                	
               
                //dataType: 'json',
                //async: false,
                processData: false,
                contentType: false,
            }).done(function(res) {
                $('img').eq(0).attr('src','/images/'+res);
            }).fail(function(res) {
                console.log(res)
            });
        });

    })
</script>