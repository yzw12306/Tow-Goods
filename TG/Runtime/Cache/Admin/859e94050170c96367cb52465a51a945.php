<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Bootstrap后台模板</title>

<link rel="stylesheet" href="/SecondProject/TG/Public/css/admin_index.css" type="text/css" media="screen">

<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.js"></script>
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
                    <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-user glyph-icon"></i> 个人中心 </a> </li>
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
    <div class="layout_footer">
        <p>Copyright © 2014 - XXXX科技</p>
    </div>
</body></html>