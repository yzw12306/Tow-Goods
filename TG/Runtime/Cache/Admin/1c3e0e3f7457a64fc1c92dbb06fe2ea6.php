<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>	
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery-2.1.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/SecondProject/TG/Public/css/bootstrap.min.css" />
	<script type="text/javascript" src="/SecondProject/TG/Public/js/bootstrap.min.js"></script>
</head>
<body>
	<table class="table table-striped table-hover">
		<tr>
			<th>id</th>
			<th>登录账号</th>
			<th>用户姓名</th>
			<th>性别</th>
			<th>出生年月</th>
			<th>email</th>
			<th>电话</th>
			<th>状态</th>
			<th>积分</th>
			<th>操作</th>
		</tr>
		
		<?php if(is_array($list)): foreach($list as $key=>$val): ?><tr>
				<td><?php echo ($val['id']); ?></td>
				<td><?php echo ($val['username']); ?></td>
				<td><?php echo ($val['realname']); ?></td>
				<td><?php echo ($val['sex']); ?></td>
				<td><?php echo ($val['birth']); ?></td>
				<td><?php echo ($val['email']); ?></td>
				<td><?php echo ($val['phone']); ?></td>
				<td>
					<a href="<?php echo U('Admin/Users/index',['id' => $val['id'] , 'status' => '1' ]);?>" class="btn btn-danger btn-xs <?php echo ($val['status']=='启用'?'disabled':''); ?>" role="button">启用</a>
					<a href="<?php echo U('Admin/Users/index',['id' => $val['id'] , 'status' => '2' ]);?>" class="btn btn-danger btn-xs <?php echo ($val['status']=='失效'?'disabled':''); ?>" role="button">失效</a>
				</td>
				<td><?php echo ($val['secord']); ?></td>
				<td><a href="<?php echo U('Admin/Users/del',['id' => $val['id'] ]);?>" onclick="delcfm()">删除</a>|<a href="<?php echo U('Admin/Users/edit',['id' => $val['id'] ]);?>">修改</a></td>
			</tr><?php endforeach; endif; ?>
	</table>
	<div><?php echo ($time); ?></div>
	<div class="btnBox"><?php echo ($show); ?></div>
</body>
<script>
	$('.btnBox').children().children().unwrap().wrap('<li></li>').parent().wrapAll('<ul class="pagination"></ul>');
	// 给当前页码高亮显示
	$('.btnBox span').parent().addClass('active');

	// 确认删除弹窗
	function delcfm() {
        if (!confirm("确认要删除？")) {
            window.event.returnValue = false;
        }
    }
    

</script>
</html>