<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 	<link rel="stylesheet" type="text/css" href="/SecondProject/TG/Public/css/bootstrap.min.css" />
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.js"></script>
	<script type="text/javascript" src="/SecondProject/TG/Public/js/bootstrap.min.js"></script>
 </head>
 <body>
 	<h1><?php echo ($title); ?></h1>
	<form class="form-horizontal" action="<?php echo U('Admin/Admins/doadd');?>" method="post">
		<div class="form-group">
			<label for="adminname" class="col-sm-2 control-label">管理员账号</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="adminname" name="adminname" placeholder="管理员账号">
			</div>
		</div>
		<div class="form-group">
			<label for="adminname" class="col-sm-2 control-label">管理员姓名</label>
			<div class="col-sm-3">
				<input type="text" name="realname" class="form-control" id="adminname" name="realname" placeholder="管理员姓名">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">设置密码</label>
			<div class="col-sm-3">
				<input type="password" name="pass" class="form-control" id="inputPassword" placeholder="请输入密码">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword1" class="col-sm-2 control-label">确认密码</label>
			<div class="col-sm-3">
				<input type="password" name="pass1" class="form-control" id="inputPassword1" placeholder="请输入确认密码">
			</div>
		</div>
		<div class="form-group">
			<label for="root" class="col-sm-2 control-label">权限</label>
			<div class="col-sm-3">
				<select id="root" name="root" class="form-control">
					<?php if(is_array($permission)): foreach($permission as $key=>$val): ?><option value="<?php echo ($val['id']); ?>" ><?php echo ($val['rolename']); ?></option><?php endforeach; endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">性别</label>
			<div class="col-sm-3">
				<div class="radio">
					<label for="man">
						<input id="man" type="radio" name="sex" value="1">男&nbsp;&nbsp;&nbsp;
					</label>
					<label for="woman">
						<input id="woman" type="radio" name="sex" value="0">女
					</label>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-3">
				<input type="submit" class="btn btn-info" value="添加">
			</div>
		</div>
	</form>
 </body>

 </html>