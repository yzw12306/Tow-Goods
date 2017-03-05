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
	<form class="form-horizontal" action="<?php echo U('Admin/Admins/doedit');?>" method="post">
		<input type="hidden" name="id" value="<?php echo ($info['id']); ?>">
		<div class="form-group">
			<label for="adminname" class="col-sm-2 control-label">管理员账号</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="adminname" value="<?php echo ($info['adminname']); ?>" disabled placeholder="管理员账号">
			</div>
			<label class="col-sm-1 control-label">禁改</label>
		</div>
		<div class="form-group">
			<label for="adminname" class="col-sm-2 control-label">管理员姓名</label>
			<div class="col-sm-3">
				<input type="text" name="realname" class="form-control" id="adminname" value="<?php echo ($info['realname']); ?>" placeholder="管理员姓名">
			</div>
			<label class="col-sm-1 control-label">必填</label>
		</div>
		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">原始密码</label>
			<div class="col-sm-3">
				<input type="password" name="pass" class="form-control" id="inputPassword" placeholder="请输入原始密码">
			</div>
			<label class="col-sm-1 control-label">必填</label>
		</div>
		<div class="form-group">
			<label for="inputPassword1" class="col-sm-2 control-label">重置密码</label>
			<div class="col-sm-3">
				<input type="password" name="newpass" class="form-control" id="inputPassword1" placeholder="请输入重置密码">
			</div>
			<label class="col-sm-1 control-label">选填</label>
		</div>
		<div class="form-group">
			<label for="inputPassword2" class="col-sm-2 control-label">确认密码</label>
			<div class="col-sm-3">
				<input type="password" name="newpass1" class="form-control" id="inputPassword2" placeholder="请输入确认密码">
			</div>
			<label class="col-sm-1 control-label">选填</label>
		</div>		
		<div class="form-group">
			<label class="col-sm-2 control-label">性别</label>
			<div class="col-sm-3">
				<div class="radio">
					<label for="man">
						<input id="man" type="radio" name="sex" value="1" <?php echo ($info['sex'] == 1 ? 'checked' : ''); ?>>男&nbsp;&nbsp;&nbsp;
					</label>
					<label for="woman">
						<input id="woman" type="radio" name="sex" value="0" <?php echo ($info['sex'] == 0 ? 'checked' : ''); ?>>女
					</label>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-3">
				<button type="submit" class="btn btn-info">保存</button>
			</div>
		</div>
	</form>
 </body>

 </html>