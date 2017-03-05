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
        	margin-left:220px;
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
						<div class="step_done">
								<div class="step_name">接受邮件</div>
								<div class="step_no"></div>
						</div>
					</li>
					<!-- <li>
						<div class="step_done">
							<div class="step_name">激活成功</div>
							<div class="step_no"></div>
						</div>
					</li> -->
					<li class="step_last">
						<div class="step_cur">
							<div class="step_name">激活成功</div>
							<div class="step_no"></div>
						</div>
					</li>
				</ol>
			</div>
            <?php if($info == 'ok'): ?><div class='cont' >
    			<br>
    			<span style='font-size:19px;'>~(～￣▽￣)～恭喜激活成功，<a href="<?php echo U('Home/Login/login');?>">点击此处进入二货网</a>！<br></span>
    			</div>
            <?php else: ?>
                <div class='cont' >
                <br>
                <span style='font-size:19px;'>╮(╯_╰)╭ 该账号已激活,请勿重复操作.<a href="<?php echo U('Home/Login/login');?>">点击此处进入二货网</a></span>
                </div><?php endif; ?>

			<div class="clear"></div>
			<div id='long'></div>
        </div>
        <?php echo W('Cate/foot');?>
    </body>
</html>