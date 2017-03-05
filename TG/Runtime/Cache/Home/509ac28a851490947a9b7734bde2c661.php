<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>二货网|欢迎注册</title>
        <style>
        .img_login{
            margin-top:-20px;
        }
        #nametips{
            position:absolute;
            color:#a22;
            font-size:17px;
            right:-130px;
            top:65px;
        }
        #passtips{
            position:absolute;
            color:#a22;
            font-size:17px;
            right:-132px;
            top:125px;
        }
        #repeattips{
            position:absolute;
            color:#a22;
            font-size:17px;
            right:-180px;
            top:190px;
        }
        #emailtips{
            position:absolute;
            color:#a22;
            font-size:17px;
            left:350px;
            top:250px;
            white-space:nowrap;
        }
        </style>
        <script type="text/javascript" src="/project/TG/Public/js/jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/registered.css">
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/header_nav_footer.css">
        <link rel="shortcut icon" type="image/x-icon" href="/project/TG/Public/Home_images/icon.png">
        
    </head>
    <body>
        <div class="header_login">
            <div class="img_login"><a href="<?php echo U('Home/Index/index');?>"><img src="/project/TG/Public/Home_images/logo.png"></a></div>  
            <div class="clear"></div>
        </div>
        <div class="box">
            <div class="main">
                
                <div class="login">
                    <div class="login_bar"><a href="<?php echo U('Home/Login/login');?>" target="_self">登录</a><a href="<?php echo U('Home/Register/register');?>" target="_self" style="color:#32a5e7; border-left:1px solid #aaaaaa;">注册</a></div>
                    <form action="<?php echo U('Home/Register/do_register');?>" method="post">
                        <div class="login_box" >
                            <div id='nametips'></div>
                            <input type="text" name="username" class="input_css input_name" placeholder="请输入账号">
                        </div> 
                        <div class="login_box clear">
                            <div id='passtips'></div>
                            <input type="password" name="pass" class="input_css input_pass" placeholder="请输入密码">
                        </div> 
                        <div class="login_box clear">
                            <div id='repeattips'></div>
                            <input type="password" name="passrepeat" class="input_css input_email" placeholder="再次输入密码">
                        </div> 

                        <div class="login_box clear">
                            <div id='emailtips'></div>
                            <input type="text" name="email" class="input_css input_email" placeholder="请输入你的邮箱地址">
                        </div> 

                        <!--验证码-->
                        <!-- <div class="validation">

                            <input type="text" name="vcode" placeholder="请输入验证码">
                            <span><img src="<?php echo U('Home/login/code');?>" title="点击验证码框切换验证码" onclick="this.src='<?php echo U('Home/login/code');?>?'+new Date().getTime();" height="36px" width='100px'></span>
                        </div> -->
                        <div class="login_box">
                            <input type="submit" value="注册" id="login_button" >
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
            $.post("<?php echo U('Home/Register/ajax_reg');?>",{'username':$(this).val()},function(data){
                if(data){
                    $('#nametips').html('*该用户名已存在');
                }else{
                    $('#nametips').html('');
                }
            });
        });

        $('input:eq(1)').blur(function(){
            var str = $(this).val();
            if(str.length >= 6 &&str.length <= 12){
                $('#passtips').html('');
            }else if(str.length == 0){
                 $('#passtips').html('*密码不能为空&nbsp&nbsp&nbsp&nbsp');
            }else{
                 $('#passtips').html('*密码为6-12字符');
            }
        });

         $('input:eq(2)').blur(function(){
            
            if($(this).val() !== $('input:eq(1)').val()){
                 $('#repeattips').html('*两次输入的密码不一致');
            }else{
                $('#repeattips').html('');
            }
        });

         $('input:eq(3)').blur(function(){
            var str = $(this).val();
            var reg = /^[0-9a-zA-Z_]+@[0-9a-zA-Z_]+\.[0-9a-zA-Z_]+$/;
            if(reg.test(str)){
                $('#emailtips').html('');
            }else if(str.length == 0){
                 $('#emailtips').html('*邮箱不能为空&nbsp&nbsp&nbsp&nbsp');
            }else{
                 $('#emailtips').html('*请输入正确的邮箱地址');
            }
        });

    </script>
</html>