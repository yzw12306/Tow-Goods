<?php if (!defined('THINK_PATH')) exit();?><div class="navbar navbar-top navbar-inverse">
	<!-- 顶部导航栏开始 -->
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="brand" href="#">TG二货后台管理系统</a>
			<!-- the new toggle buttons -->
			<ul class="nav pull-right">
				<li class="toggle-primary-sidebar hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-primary">
					<button type="button" class="btn btn-navbar"><i class="icon-th-list"></i></button>
				</li>
				<li class="hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-top">
					<button type="button" class="btn btn-navbar"><i class="icon-align-justify"></i></button>
				</li>
			</ul>     
			<div class="nav-collapse nav-collapse-top collapse">
				<ul class="nav full pull-right">
					<li class="dropdown user-avatar">
					<!-- the dropdown has a custom user-avatar class, this is the small avatar with the badge -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span>
								<img class="menu-avatar" src="/SecondProject/TG/Public/images/avatars/avatar1.jpg" /> 
								<span>杨宗文<i class="icon-caret-down"></i></span>
								<span class="badge badge-dark-red">5</span>
							</span>
						</a>
						<ul class="dropdown-menu">
							<!-- the first element is the one with the big avatar, add a with-image class to it -->
							<li class="with-image">
								<div class="avatar">
									<img src="/SecondProject/TG/Public/images/avatars/avatar1.jpg" />
								</div>
								<span>杨宗文</span>
							</li>
							<li class="divider"></li>
							<li><a href="#"><i class="icon-user"></i> <span>杨宗文</span></a></li>
							<li><a href="#"><i class="icon-cog"></i> <span>设置</span></a></li>
							<li><a href="#"><i class="icon-envelope"></i> <span>信息</span> <span class="label label-dark-red pull-right">5</span></a></li>
							<li><a href="#"><i class="icon-off"></i> <span>注销</span></a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-search pull-right" />
					<input type="text" class="search-query animated" placeholder="搜索" />
					<i class="icon-search"></i>
				</form>
				<ul class="nav pull-right">
					<li class="active"><a href="#" title="Go home"><i class="icon-home"></i> 首页</a></li>
					<li><a href="#" title="Manage users"><i class="icon-user"></i> 用户组</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">下拉 <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Some link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航栏结束 -->
</div>