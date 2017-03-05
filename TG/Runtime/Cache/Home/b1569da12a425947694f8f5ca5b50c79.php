<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>二货网|欢迎登录</title>
        <script type="text/javascript" src="/project/TG/Public/js/jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/login.css">
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/header_nav_footer.css">        
        <link rel="shortcut icon" type="image/x-icon" href="/project/TG/Public/Home_images/icon.png">
        <style>
        .img_login{
            margin-top:-20px;
        }
        </style>
    </head>
    <body>
        <div class="header_login">
            <div class="img_login"><a href="<?php echo U('Home/Index/index');?>"><img src="/project/TG/Public/Home_images/logo.png"></a></div>
            <div class="clear"></div>
        </div>
        <div class="box">
            <div class="main">
                <div class="login">
                    <div class="login_bar"><a href="<?php echo U('Home/Login/login');?>" target="_self" style="color:#32a5e7; border-right:1px solid #aaaaaa;">登录</span><a href="<?php echo U('Home/Register/register');?>" target="_self">注册</a></div>
                    <form action="<?php echo U('Home/Login/do_login');?>" method="post">
                       
                        <div class="login_box">
                            <div id='tips' style="color:#e23;"></div>        
                            <input type="text" name="username" class="input_css input_name" placeholder="请输入账号">
                        </div> 

                        <div class="login_box clear">

                            <input type="password" name="pass" class="input_css input_pass" placeholder="请输入密码">
                        </div> 
                        <!--验证码-->
                        <div class="validation">
                            <input type="text" name="vcode" placeholder="请输入验证码">
                            <span><img src="<?php echo U('Home/login/code');?>" title="点击验证码框切换验证码" onclick="this.src='<?php echo U('Home/login/code');?>?'+new Date().getTime();" height="36px" width='100px'></span>
                        </div>
                        <div class="login_box">

                            <input type="submit" value="登录" id="login_button" >
                        </div>
                        
                        <div class="state">

                            <span><a href="<?php echo U('Home/Register/register');?>">注册</a></span>
                            <span><a href="<?php echo U('Home/Find/index');?>">忘记密码</a></span>
                        </div>
                    </form>
                    <center style="color: red;">
                        </center>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="login_footer">
            <div class="footer_nav">
                <ul>
                    <li><a href="#">关于二货</a></li>
                    <li><a href="#">工作机会</a></li>
                    <li><a href="#">联系我们</a></li>
                    <li><a href="#">法律声明</a></li>
                    <li style="border:0px;"><a href="#">常见问题</a></li>
                </ul>                
            </div>
            <div class="connect">
                <ul>
                    <li>客服热线</li>
                    <li>400-788-3333</li>
                    <li><a href="#">在线客服</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="info">
                <span>©2016 Meizu Telecom Equipment Co., Ltd. All rights reserved.&nbsp;&nbsp;&nbsp;&nbsp;备案号: 粤ICP备13003602号-4&nbsp;&nbsp;&nbsp;&nbsp;经营许可证编号: 粤B2-20130198</span>
            </div>
        </div>
    </body>
    <script>
        $('input:eq(0)').blur(function(){
            $.post("<?php echo U('Home/login/ajax_login');?>",{'username':$(this).val()},function(data){
                if(data){
                    $('#tips').html('*该用户名不存在');
                }else{
                    $('#tips').html('');
                }

            });
        });
    </script>
</html>