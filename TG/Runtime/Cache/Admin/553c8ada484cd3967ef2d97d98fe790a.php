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

 	<table class="table table-hover">
 		<tr>
 			<th>编号</th>
 			<th>角色名</th>
 			<th>角色简介</th>		
 			<th>操作</th>
 		</tr>
 		<?php if(is_array($list)): foreach($list as $key=>$val): ?><tr>
 				<td><?php echo ($val['id']); ?></td>
 				<td><?php echo ($val['rolename']); ?></td>
 				<td><?php echo ($val['roledescription']); ?></td>
 				<td>
 					<!-- <a class="btn btn-warning  btn-xs"  href="<?php echo U('Admin/Permission/edit',['id' => $val['id'] ]);?>">修改</a> -->
 					<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modRole" data-whatever="<?php echo ($val['id']); ?>">修改</button>
 					<!-- <a class="btn btn-danger  btn-xs"  href="<?php echo U('Admin/Permission/del',['id' => $val['id'] ]);?>">删除</a> -->
 					<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delRole" data-whatever="<?php echo ($val['id']); ?>">删除</button>
 				</td>
 			</tr><?php endforeach; endif; ?>
 	</table>
 	<div id="btnBox">
 		<?php echo ($show); ?>
 	</div>

 	<!-- 是否具有修改角色权限信息的模态框 -->
	<div class="modal fade" id="modRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel" style="color:blue;font-weight:bold;">修改角色</h3>
				</div>
				<form class="form-horizontal" action="<?php echo U('Admin/Permission/edit');?>" method="post">					
					<div class="modal-body">						 
						<div id="modRoleId" class="container-fluid">
						
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<input id="modifyRole" type="submit" class="btn btn-primary" value="保存">
					</div>
				</form> 
			</div>
		</div>
	</div>

	<!-- 是否具有删除角色权限信息的模态框 -->
	<div class="modal fade" id="delRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel" style="color:blue;font-weight:bold;">删除角色</h3>
				</div>
				<form class="form-horizontal" action="<?php echo U('Admin/Permission/del');?>" method="post">					
					<div class="modal-body">						 
						<div id="delRoleId" class="container-fluid">
						
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<input id="deleteRole" type="submit" class="btn btn-primary" value="保存">
					</div>
				</form> 
			</div>
		</div>
	</div>

 </body>
 <script>

	// 将数字按钮进行包裹
	$('#btnBox').children().children().unwrap().wrap('<li></li>').parent().wrapAll('<ul class="pagination"></ul>');

	// 给当前页码高亮显示
	$('#btnBox span').parent().addClass('active');

	//模态框显示角色权限的修改信息
	$('#modRole').on('show.bs.modal', function (event) {

		var button = $(event.relatedTarget); 

		//变量data里是一个js数组data[0]代表管理员id的值，data[1]代表角色id的值。
	  	var res_mod = button.data('whatever'); 

	   	$.ajax({

	        // 请求的地址
	        'url' : "<?php echo U('Admin/Admins/doCheck');?>",

	        // 是否异步
	        'async' : true,

	        'data' :{

	        		'root': res_mod

			    },

	        // 数据类型
	        'dataType' : 'json',

	        // 请求方式
	        'type' : 'POST',

	        // 成功回调
	        'success' : function(data){
	        	
	        	console.dir(data);

	        	//第一种清空方法
	        	$("#modRoleId").empty();

	        	$("#modifyRole").remove();

	        	if(data){

		        	$("#modRole .modal-footer").prepend('<input id="modifyRole" type="submit" class="btn btn-danger" value="修改">');
		        	$("#modRoleId").append('<p style="color:lightblue;font-weight:bold;">您确定要修改该角色权限吗？</p>');

				}else{

					$("#modRoleId").append('<p style="color:red;font-weight:bold;">您的角色权限无法对此角色权限进行修改操作！</p>');

				}

	        	//插入隐藏域的管理员id值到form表单里
	        	$("#modRoleId").append('<input type="hidden" name="id" value="' + res_mod + '">');
	        	        	
	        }

	    });

	});


	//模态框显示角色权限的删除信息
	$('#delRole').on('show.bs.modal', function (event) {

		var button = $(event.relatedTarget); 

		//变量data里是一个js数组data[0]代表管理员id的值，data[1]代表角色id的值。
	  	var res_del = button.data('whatever'); 

	   	$.ajax({

	        // 请求的地址
	        'url' : "<?php echo U('Admin/Admins/doCheck');?>",

	        // 是否异步
	        'async' : true,

	        'data' :{

	        		'root': res_del

			    },

	        // 数据类型
	        'dataType' : 'json',

	        // 请求方式
	        'type' : 'POST',

	        // 成功回调
	        'success' : function(data){
	        	
	        	console.dir(data);

	        	//第一种清空方法
	        	$("#delRoleId").empty();

	        	$("#deleteRole").remove();

	        	if(data){

		        	$("#delRole .modal-footer").prepend('<input id="deleteRole" type="submit" class="btn btn-danger" value="删除">');
		        	$("#delRoleId").append('<p style="color:lightblue;font-weight:bold;">您确定要删除该角色权限吗？</p>');

				}else{

					$("#delRoleId").append('<p style="color:red;font-weight:bold;">您的角色权限无法对此角色权限进行删除操作！</p>');

				}

	        	//插入隐藏域的管理员id值到form表单里
	        	$("#delRoleId").append('<input type="hidden" name="id" value="' + res_del + '">');
	        	        	
	        }

	    });

	});

</script>
 </html>