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
	<table class="table table-striped">
		<tr>
			<th>分类id</th>
			<th>分类名称</th>
			<th>父类id号</th>
			<th>分类路径</th>
			<th>操作</th>
		</tr>

		<?php if(is_array($list)): foreach($list as $key=>$val): ?><tr>
				<td><?php echo ($val['id']); ?></td>
				<td><?php echo ($val['name']); ?></td>
				<td><?php echo ($val['pid']); ?></td>
				<td><?php echo ($val['path']); ?></td>
				<td><a href="<?php echo U('Admin/Type/edit',['id'=> $val['id'], 'pid' => $val['pid']]);?>">修改 </a>|<a href="<?php echo U('Admin/Type/add',['name'=> $val['name'],'pid'=>$val['id'],'path'=>$val['path']]);?>"> 添加 </a>|<a href="<?php echo U('Admin/Type/del',['id' => $val['id']]);?>" onclick="delcfm()"> 删除 </a></td>
			</tr><?php endforeach; endif; ?>
	</table>

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