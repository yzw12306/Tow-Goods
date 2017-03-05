<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Bootstrap后台模板</title>

       
        <link rel="stylesheet" type="text/css" href="/SecondProject/TG/Public/css/bootstrap.min.css" />
        <script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.js"></script>
        <script type="text/javascript" src="/SecondProject/TG/Public/js/bootstrap.min.js"></script>      

        <link rel="stylesheet" href="/SecondProject/TG/Public/css/admin_index.css" type="text/css" media="screen">
        <!-- <script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.js"></script> -->
        <script type="text/javascript" src="/SecondProject/TG/Public/js/tendina.js"></script>
        <script type="text/javascript" src="/SecondProject/TG/Public/js/common.js"></script>

        <style type="text/css">
            #ad_setting ul.dropdown-menu-uu li.ad_setting_ul_li a{
                display: block;
                width:130px;
                height:30px;
            }   
        </style>
    </head>
    <body>
         <!--顶部-->
    <div class="layout_top_header">
            <div style="float: left"><span style="font-size: 16px;line-height: 45px;padding-left: 20px;color: #8d8d8d">G23管理后台</span></div>
            <div id="ad_setting" class="ad_setting">
                <a class="ad_setting_a" href="javascript:;">
                    <i class="icon-user glyph-icon" style="font-size: 20px"></i>
                    <span><?php echo ($_SESSION["admin"]["adminname"]); ?></span>
                    <i class="icon-chevron-down glyph-icon"></i>
                </a>
                <ul class="dropdown-menu-uu" style="display: none" id="ad_setting_ul">
                    <li class="ad_setting_ul_li"> <a href="#lookPerson" data-toggle="modal"  data-whatever="<?php echo ($_SESSION['admin']['id']); ?>"><i class="icon-user glyph-icon"></i> 个人信息 </a> </li>
                   <!--  <li class="ad_setting_ul_li"> <button style="border:0px" type="button" data-toggle="modal" data-target="#lookPerson" data-whatever="[<?php echo ($_SESSION['admin']['id']); ?>]"><i class="icon-user glyph-icon"></i> 个人中心</button></li> -->
                    <li class="ad_setting_ul_li"> <a target="menuFrame" href="<?php echo U('/Admin/Admins/edit', ['id' => $_SESSION['admin']['id']]);?>"><i class="icon-cog glyph-icon"></i> 设置 </a> </li>
                    <li class="ad_setting_ul_li"> <a href="<?php echo U('/Admin/login/logout');?>"><i class="icon-signout glyph-icon"></i> <span class="font-bold">退出</span></a></li>
                </ul>
            </div>
    </div>
    <!--顶部结束-->

    
    	<!--菜单-->
    <div class="layout_left_menu">
        <ul class="tendina" id="menu">
            <li class="childUlLi">
               <a href="<?php echo U('Admin/Index/Index');?>"><i class="glyph-icon icon-home"></i>首页</a>
            </li>
            <li class="childUlLi">
                <a href="#" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>系统管理</a>
                <ul style="display: none;">
                    <li><a target="menuFrame" href="<?php echo U('Admin/Admins/Index');?>"><i class="glyph-icon icon-chevron-right"></i>管理员列表</a></li>
                    <li><a target="menuFrame"  href="<?php echo U('Admin/Admins/Add');?>"><i class="glyph-icon icon-chevron-right"></i>添加管理员</a></li>
                </ul>
            </li>
			<li class="childUlLi">
                <a href="#"> <i class="glyph-icon  icon-location-arrow"></i>权限管理</a>
                <ul style="display: none;">
                    <li><a target="menuFrame"  href="<?php echo U('Admin/Permission/Index');?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>角色列表</li>
                    <li><a target="menuFrame"  href="<?php echo U('Admin/Permission/Add');?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>添加角色</a></li>
                </ul>
            </li>

            <li class="childUlLi">
                <a href="#" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>用户管理</a>
                <ul style="display: none;">
                    <li><a href="<?php echo U('Admin/Users/index');?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>用户列表</a></li>
                </ul>
            </li>
            
            <li class="childUlLi">
                <a href="#"> <i class="glyph-icon icon-location-arrow"></i>分类管理</a>
                <ul style="display: none;">
                    <li><a href="<?php echo U('Admin/Type/index');?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>分类列表</li>
                    <li><a href="<?php echo U('Admin/Type/add');?>" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>添加父类</a></li>
                </ul>
            </li>

            <li class="childUlLi">
                <a href="#"> <i class="glyph-icon icon-reorder"></i>商品管理</a>
                <ul style="display: none;">
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>商品列表</li>
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>添加商品</a></li>
                </ul>
            </li>
			
			<li class="childUlLi">
                <a href="#"> <i class="glyph-icon  icon-location-arrow"></i>公告管理</a>
                <ul style="display: none;">
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>公告列表</li>
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>添加公告</a></li>
                </ul>
            </li>          
			<li class="childUlLi">
                <a href="#"> <i class="glyph-icon  icon-reorder"></i>链接管理</a>
                <ul style="display: none;">
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>链接列表</li>
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>添加链接</a></li>
                </ul>
            </li>
            <li class="childUlLi">
                <a href="#"> <i class="glyph-icon  icon-location-arrow"></i>广告告管理</a>
                <ul style="display: none;">
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>广告列表</li>
                    <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>添加广告</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!--菜单-->

        <div id="layout_right_content" class="layout_right_content">
            <div class="route_bg">
                <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
                <a href="#">菜单管理</a>
            </div>
            <div class="mian_content">
                <div id="page_content">
                    <iframe id="menuFrame" name="menuFrame" src="<?php echo U('Admin/Index/main');?>" style="overflow:visible;" scrolling="yes" frameborder="no" height="100%" width="100%"></iframe>
                </div>
            </div>
        </div>

        <!-- 查看管理员详细信息的模态框 -->
        <div class="modal fade" id="lookPerson" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="color:blue;font-weight:bold;">查看个人详细信息</h4>
                    </div>                                  
                    <div class="modal-body">                         
                        <div id="personId" class="container-fluid">
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="layout_footer">
            <p>Copyright © 2014 - XXXX科技</p>
        </div>
    </body>
    <script type="text/javascript">
           
        //模态框显示管理员的模块权限信息
        $('#lookPerson').on('show.bs.modal', function (event) {  

            var button = $(event.relatedTarget); 
           
            var id = button.data('whatever'); 

            $.ajax({

                // 请求的地址
                'url' : "<?php echo U('Admin/Admins/lookPerson');?>",

                // 是否异步
                'async' : true,

                'data' :{

                        'id': id

                    },

                // 数据类型
                'dataType' : 'json',

                // 请求方式
                'type' : 'GET',

                // 成功回调
                'success' : function(data){
                    
                    // alert(data);
                    // console.dir(data);

                    //第一种清空方法
                    $("#personId").empty();

                    $("#personId").append('<p class="col-sm-2"><b style="color:blue;font-size: 18px">管理员:</b></p><p class="col-sm-10"><b style="color:red;font-size: 18px">' + data['adminname'] + '</b></p>');

                    $("#personId").append('<p class="col-sm-3"><b style="color:blue;font-size: 18px">真实姓名:</b></p><p class="col-sm-9"><b style="color:red;font-size: 18px">' + data['realname'] + '</b></p>');
                    $("#personId").append('<p class="col-sm-2"><b style="color:blue;font-size: 18px">性别:</b></p><p class="col-sm-10"><b style="color:red;font-size: 18px">' + data['sex'] + '</b></p>');

                    $("#personId").append('<p class="col-sm-2"><b style="color:blue;font-size: 18px">角色:</b></p><p class="col-sm-10"><b style="color:red;font-size: 18px">' + data['rolename'] + '</b></p>');

                    $("#personId").append('<p class="col-sm-2"><b style="color:blue;font-size: 18px">状态:</b></p><p class="col-sm-10"><b style="color:red;font-size: 18px">' + data['statusname'] + '</b></p>');

                    $("#personId").append('<p class="col-sm-3"><b style="color:blue;font-size: 18px">注册时间:</b></p><p class="col-sm-9"><b style="color:red;font-size: 18px">' + data['addtime'] + '</b></p>');                  
                  
                    $("#personId").append('<p class="col-sm-4"><b style="color:blue;font-size: 18px">上次登录时间:</b></p><p class="col-sm-8"><b style="color:red;font-size: 18px">' + data['logintime'] + '</b></p>');  

                }

            });

        });

        

        // //模态框显示管理员的模块权限信息
        // $('#lookPerson').on('show.bs.modal', function (event) {

        //     var button = $(event.relatedTarget); 

        //     //变量data里是一个js数组data[0]代表管理员id的值，data[1]代表角色id的值。
        //     var id = button.data('whatever'); 

        //     // alert(id);

        //     $.ajax({

        //         // 请求的地址
        //         'url' : "<?php echo U('Admin/Admins/lookPerson');?>",

        //         // 是否异步
        //         'async' : true,

        //         'data' :{

        //                 'id': id

        //             },

        //         // 数据类型
        //         'dataType' : 'json',

        //         // 请求方式
        //         'type' : 'GET',

        //         // 成功回调
        //         'success' : function(data){
                    
        //             // alert(data);
        //             console.dir(data);

        //             //第一种清空方法
        //             // $("#personId").empty();

        //             // $("#personId").append('<p class="col-sm-12"><b style="color:red;font-size: 20px">' + data['rolename'] + '</b>拥有的模块权限如下：</p>');

        //             // for (var i = 0; i < data['modulenames'].length; i++) {

        //             //     $("#personId").append('<label class="col-sm-3">' + data['modulenames'][i] + '</label>');

        //             }

        //         }

        //     });

        // });

    </script>
</html>