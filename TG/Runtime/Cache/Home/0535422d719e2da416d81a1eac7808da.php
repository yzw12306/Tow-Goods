<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>二货网|找回密码</title>
        <script type="text/javascript" src="/project/TG/Public/js/jquery.js"></script>
        <script type="text/javascript" src="/project/TG/Public/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/project/TG/Public/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/login.css">
        <link type="text/css" rel="stylesheet" href="/project/TG/Public/css/header_nav_footer.css">
        <link rel="shortcut icon" type="image/x-icon" href="/project/TG/Public/Home_images/icon.png">
        <style>
        body{
            background:#eee;
        }
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
        .img_login{
            margin-top:-20px;
        }
        .find_body{
            width:100%;
            height:500px;
            background:#fff;
        }
        .container{
            background:#eee;
        }
        .dept{
            margin:40px;
        }
        .p1{
            margin-left:40px;
            font-size:14px;
            font-weight:bold;
        }
        .ipt{
            margin-left:40px;
            margin-top:20px;
            line-height:25px;
        }
        .emaillink{
            margin-left:460px;
            margin-top:30px;
        }
       
        </style>
    </head>
    <body>
        <div class='container'>
        <div class="header_login">
            <div class="img_login"><a href="<?php echo U('Home/index/index');?>"><img src="/project/TG/Public/Home_images/logo.png"></a></div>
            <div class="clear"></div>
        </div>
        <div class='line'></div>
        <div class="box">
            <div class="find_body ">
            <div class='line'></div>
                <div class='dept'><img src="/project/TG/Public/Home_images/mima.jpg" width='400px' alt=""></div>

                <div class='p1'><span style='font-size:18px;'>~(～￣▽￣)～您已通过信息验证，请前往绑定邮箱进行下一步操作~</span></div>
                

                <div class='emaillink'>
                    <a href="https://mail.qq.com/">QQ邮箱>></a><br>
                    <a href="http://mail.163.com/">163邮箱>></a><br>
                    <a href="http://mail.sina.com.cn/">新浪邮箱>></a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="login_footer">
            <div class="footer_nav">
                <ul>
                    <li><a href="#">关于魅族</a></li>
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
        </div>
    </body>
    <script>
       
        $('input:eq(0)').blur(function(){
            $.post("<?php echo U('Home/Find/ajax_find');?>",{'username':$(this).val()},function(data){
                if($('input:eq(0)').val() == ''){
                    $('#nametips').html('*账号不能为空');
                }else if(!data){
                    $('#nametips').html('*该用户名不存在');
                }else{
                    $('#nametips').html('');
                    $('#user_id')[0].setAttribute('value',data);
                }

            });
        });

        $('input:eq(1)').blur(function(){
            if($(this).val() == ''){
                $('#emailtips').html('*邮箱不能为空');
            }else{
                $('#emailtips').html('');
            }
        });

        
    </script>
</html>