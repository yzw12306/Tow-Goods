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
	<form class="form-horizontal" action="<?php echo U('Admin/Permission/doadd');?>" method="post">
		<div class="form-group">
			<label for="rolename" class="col-sm-2 control-label">角色名</label>
			<div class="col-sm-3">
				<input type="text" name="rolename" class="form-control" id="rolename" placeholder="角色名">
			</div>
		</div>
		<div class="form-group">
			<label for="roledescription" class="col-sm-2 control-label">角色简介</label>
			<div class="col-sm-3">
				<textarea name="roledescription" id="" cols="30" rows="10"></textarea>
				<!-- <input type="text" name="realname" class="form-control" id="roledescription" value="<?php echo ($info['realname']); ?>" placeholder="管理员姓名"> -->
			</div>
		</div>
		<div class="form-group">
			<label for="checkbox" class="col-sm-2 control-label">模块权限</label>
			<?php if(is_array($modules)): foreach($modules as $key=>$val): ?><div class="col-sm-2">
				<?php echo ($val['modulename']); ?>&nbsp;
				<input type="checkbox" name="moduleval[]" value="<?php echo ($val['moduleval']); ?>">	
				</div><?php endforeach; endif; ?>		
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-3">
				<button type="submit" class="btn btn-info">保存</button>
			</div>
		</div>
	</form>
 </body>

 </html>