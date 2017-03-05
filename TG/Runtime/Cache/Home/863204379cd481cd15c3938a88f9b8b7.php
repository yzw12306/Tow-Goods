<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta charset="utf-8">
        <title>二货网|注册成功</title>
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/header_nav_footer.css">
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/myorders_info.css">
        <style>
			.header_login{
            width:100%;
            height:100px;
            background:#fff;
        }
        .line{
            width:100%;
            height:2px;
            background:#eee;
        }
        #long{
        	height:400px;
        }
        .cont{
        	margin-left:250px;
        	margin-top:50px;
        }
        .emaillink{
        	margin-left:320px;
        	margin-top:50px;
        }
        </style>
    </head>
    <body>
        <hr style="background-color:#E5E5E5; height:1px; border:0px;">
        <div class="content">
	<div class="header_login">
            <div class="img_login"><a href="<?php echo U('Home/index/index');?>"><img src="/project/TG/Public/Home_images/logo.png"></a></div>
            <div class="clear"></div>
        </div>
        <div class='line'></div>
			<div class="flowstep">
				<ol class="detail_stepbar">
					<li class="step_first">
						<div class="step_done">
							<div class="step_name">注册</div>
							<div class="step_no"></div>
						</div>
					</li>
					<li>
						<div class="step_last">
							<div class="step_curi">
								<div class="step_name">接受邮件</div>
								<div class="step_no"></div>
							</div>
						</div>
					</li>
					<!-- <li>
						<div class="step_done">
							<div class="step_name">激活成功</div>
							<div class="step_no"></div>
						</div>
					</li> -->
					<li class="step_last">
						<div class="step_cura">
							<div class="step_name">激活成功</div>
							<div class="step_no"></div>
						</div>
					</li>
				</ol>
			</div>
			<div class='cont' >
			<br>
			<span style='font-size:19px;'>b(￣▽￣)d注册成功，请进入您的邮箱进行账号激活!<br></span>
				<div class='emaillink'>
					<a href="https://mail.qq.com/">QQ邮箱>></a><br>
					<a href="http://mail.163.com/">163邮箱>></a><br>
					<a href="http://mail.sina.com.cn/">新浪邮箱>></a>
				</div>

			</div>

			<div class="clear"></div>
			<div id='long'></div>
        </div>
        <?php echo W('Cate/foot');?>
    </body>
</html>