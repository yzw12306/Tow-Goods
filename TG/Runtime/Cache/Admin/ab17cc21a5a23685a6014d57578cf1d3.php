<?php if (!defined('THINK_PATH')) exit();?>﻿<html>
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>登录(Login)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="/SecondProject/TG/Public/css/reset.css">
        <link rel="stylesheet" href="/SecondProject/TG/Public/css/supersized.css">
        <link rel="stylesheet" href="/SecondProject/TG/Public/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="/SecondProject/TG/Public/js/html5.js"></script>
        <![endif]-->

    </head>

    <body>

        <div class="page-container">
            <h1>登录(Login)</h1>
            <form action="<?php echo U('Admin/Login/dologin');?>" method="post">
                <input id="adminname" type="text" name="adminname" class="adminname" placeholder="请输入您的用户名！">
                <input type="password" name="pass" class="pass" placeholder="请输入您的用户密码！">
                <input type="Captcha" class="Captcha" name="code" placeholder="请输入验证码！">
                
                <img style="margin-top: 25px" src="./code.html" alt="" onclick="javascript:this.src='./code.html?id='+Math.random()" width="120" height="40">
              
                <button type="submit" class="submit_button">登录</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <!-- <p>快捷</p> -->
              <!--   <p>
                    <a class="facebook" href=""></a>
                    <a class="twitter" href=""></a>
                </p> -->
            </div>
        </div>
		
        <!-- Javascript -->
        <script src="/SecondProject/TG/Public/js/jquery-1.8.2.min.js" ></script>
        <script src="/SecondProject/TG/Public/js/supersized.3.2.7.min.js" ></script>
        <script src="/SecondProject/TG/Public/js/supersized-init.js" ></script>
        <script src="/SecondProject/TG/Public/js/scripts.js" ></script>

    </body>
    <script type="text/javascript">

        $("#adminname").blur(function(){

            var adminname = $("#adminname").val();

            $.ajax({

                // 请求的地址
                'url' : "<?php echo U('Admin/Login/check');?>",

                // 是否异步
                'async' : true,

                'data' :{

                        'adminname': adminname

                    },

                // 数据类型
                'dataType' : 'json',

                // 请求方式
                'type' : 'POST',

                // 成功回调
                'success' : function(data){

                    // alert(data);

                    if(!data)
                    {
                        $(".connect").html('<div width="300px" height="30px"  style="color:red;font-size:25px">抱歉！账号不存在！</div>');
                       

                    }
                    else{

                        $(".connect").html('<div width="300px" height="30px" style="color:blue;font-size:30px"></div>');

                    }

                }
            });

        });

    </script>

</html>