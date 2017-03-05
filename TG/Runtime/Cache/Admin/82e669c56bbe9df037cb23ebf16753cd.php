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

 	<table class="table table-hover table-striped">
 		<tr>
 			<th>编号</th>
 			<th>账号</th>
 			<th>真实姓名</th>
 			<th>性别</th>
 			<th>权限</th>
 			<th>状态</th>
 			<th>添加时间</th>
 			<th>最近登录时间</th>
 			<th>操作</th>
 		</tr>
 		<?php if(is_array($list)): foreach($list as $key=>$val): ?><tr>
 				<td><?php echo ($val['id']); ?></td>
 				<td><?php echo ($val['adminname']); ?></td>
 				<td><?php echo ($val['realname']); ?></td>
 				<td><?php echo ($val['sex']); ?></td>
 				<td><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#changeRole" data-whatever="[<?php echo ($val['id']); ?>,<?php echo ($val['root']); ?>]"><?php echo ($val['rolename']); ?></button></td>
 				<td>
 					<a href="<?php echo U('Admin/Admins/index',['id' => $val['id'] , 'status' => '1' ]);?>" class="btn btn-danger btn-xs statuschange" <?php echo ($val['status']=='1'?'disabled':''); ?> role="button">启用</a>
					<a href="<?php echo U('Admin/Admins/index',['id' => $val['id'] , 'status' => '2' ]);?>" class="btn btn-danger btn-xs statuschange" <?php echo ($val['status']=='2'?'disabled':''); ?> role="button">失效</a>
 				</td>
 				<td><?php echo ($val['addtime']); ?></td>
 				<td><?php echo ($val['logintime']); ?></td>
 				<td>
 					<a class="btn btn-warning btn-xs"  href="<?php echo U('Admin/Admins/edit',['id' => $val['id'] ]);?>">修改</a>
 					<!-- <a class="btn btn-danger btn-xs"  href="<?php echo U('Admin/Admins/del',['id' => $val['id'], 'root' => $val['root'] ]);?>">删除</a> -->
 					<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delAdmin" data-whatever="[<?php echo ($val['id']); ?>,<?php echo ($val['root']); ?>]">删除</button>
 					<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#lookAdmin" data-whatever="[<?php echo ($val['id']); ?>,<?php echo ($val['root']); ?>]">查看权限</button>
 				</td>
 			</tr><?php endforeach; endif; ?>
 	</table>
 	<div id="btnBox">
 		<?php echo ($show); ?>
 	</div>

 	<!-- 角色权限修改的模态框 -->
	<div class="modal fade" id="changeRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel" style="color:blue;font-weight:bold;">修改管理员的角色权限</h3>
				</div>
				<form class="form-horizontal" action="<?php echo U('Admin/Admins/dorole');?>" method="post">
					
					<div class="modal-body">						 
						<div id="roleId" class="container-fluid">
						
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<input id="saveRole" type="submit" class="btn btn-primary" value="保存">
						<!-- <button type="button" class="btn btn-primary">保存</button> -->
					</div>
				</form> 
			</div>
		</div>
	</div>

	<!-- 查看管理员详细信息的模态框 -->
	<div class="modal fade" id="lookAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel" style="color:blue;font-weight:bold;">查看管理员的模块权限</h3>
				</div>									
				<div class="modal-body">						 
					<div id="adminId" class="container-fluid">
					
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>

	<!-- 是否具有删除管理员信息权限的模态框 -->
	<div class="modal fade" id="delAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="myModalLabel" style="color:blue;font-weight:bold;">删除管理员</h3>
				</div>
				<form class="form-horizontal" action="<?php echo U('Admin/Admins/del');?>" method="post">
					
					<div class="modal-body">						 
						<div id="adminDelId" class="container-fluid">
						
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<input id="deleteAdmin" type="submit" class="btn btn-primary" value="保存">
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

	//模态框显示管理员的模块权限信息
	$('#delAdmin').on('show.bs.modal', function (event) {

		var button = $(event.relatedTarget); 

		//变量data里是一个js数组data[0]代表管理员id的值，data[1]代表角色id的值。
	  	var res_del = button.data('whatever'); 

	   	$.ajax({

	        // 请求的地址
	        'url' : "<?php echo U('Admin/Admins/delCheck');?>",

	        // 是否异步
	        'async' : true,

	        'data' :{

	        		'id': res_del[0],

	        		'root': res_del[1]

			    },

	        // 数据类型
	        'dataType' : 'json',

	        // 请求方式
	        'type' : 'POST',

	        // 成功回调
	        'success' : function(data){
	        	
	        	console.dir(data);

	        	//第一种清空方法
	        	$("#adminDelId").empty();

	        	$("#deleteAdmin").remove();

	        	if(data){

		        	$("#delAdmin .modal-footer").prepend('<input id="deleteAdmin" type="submit" class="btn btn-danger" value="删除">');
		        	$("#adminDelId").append('<p style="color:lightblue;font-weight:bold;">您确定要删除该管理员吗？</p>');

				}else{

					$("#adminDelId").append('<p style="color:red;font-weight:bold;">您的角色权限无法对此管理员进行删除操作！</p>');

				}
	        	//插入隐藏域的管理员id值到form表单里
	        	$("#adminDelId").append('<input type="hidden" name="id" value="' + res_del[0] + '">');

	        	$("#adminDelId").append('<input type="hidden" name="root" value="' + res_del[1] + '">');        	
	        }

	    });

	});



	//模态框显示管理员的模块权限信息
	$('#lookAdmin').on('show.bs.modal', function (event) {

		var button = $(event.relatedTarget); 

		//变量data里是一个js数组data[0]代表管理员id的值，data[1]代表角色id的值。
	  	var res_look = button.data('whatever'); 

	   	$.ajax({

	        // 请求的地址
	        'url' : "<?php echo U('Admin/Admins/lookAdmin');?>",

	        // 是否异步
	        'async' : true,

	        'data' :{

	        		'id': res_look[0],

	        		'root': res_look[1]

			    },

	        // 数据类型
	        'dataType' : 'json',

	        // 请求方式
	        'type' : 'GET',

	        // 成功回调
	        'success' : function(data){
	        	
	        	console.dir(data);

	        	//第一种清空方法
	        	$("#adminId").empty();

	        	$("#adminId").append('<p class="col-sm-12"><b style="color:red;font-size: 20px">' + data['rolename'] + '</b>拥有的模块权限如下：</p>');

	        	for (var i = 0; i < data['modulenames'].length; i++) {

		        	$("#adminId").append('<label class="col-sm-3">' + data['modulenames'][i] + '</label>');

		     	}

	        }

	    });

	});


	//模态框显示角色权限更改
	$('#changeRole').on('show.bs.modal', function (event) {

		var button = $(event.relatedTarget); 

		//变量data里是一个js数组data[0]代表管理员id的值，data[1]代表角色id的值。
	  	var res_change = button.data('whatever'); 

	   	$.ajax({

	        // 请求的地址
	        'url' : "<?php echo U('Admin/Admins/role');?>",

	        // 是否异步
	        'async' : true,

	        'data' :{

	        		'id': res_change[0],

	        		'root': res_change[1]

			    },

	        // 数据类型
	        'dataType' : 'json',

	        // 请求方式
	        'type' : 'POST',

	        // 成功回调
	        'success' : function(data){
	        	
	        	//第一种清空方法
	        	$("#roleId").empty();

	        	$("#saveRole").remove();

	        	$("#changeRole .modal-footer").prepend('<input id="saveRole" type="submit" class="btn btn-primary" value="保存">');

	        	//第二种清空方法
	        	// $("#roleId").children().remove();
	        
	        	//插入隐藏域的管理员id值到form表单里
	        	$("#roleId").append('<input type="hidden" name="id" value="' + res_change[0] + '">');

	        	//在模态框里遍历插入单选角色权限按钮
	        	for (var i = 0; i < data.length; i++) {

	        		//判断是否选中单选按钮
	        		if(data[i]['sign'])
	        		{

	        			$("#roleId").append('<div class="col-sm-4"><input type="radio" id="radio' + i + '" name="root" value="' + data[i]['id'] + '" checked >&nbsp;<label for="radio' + i + '">' + data[i]['rolename'] + '</label></div>');

	        		}else
	        		{

	        			$("#roleId").append('<div class="col-sm-4"><input type="radio" id="radio' + i + '" name="root" value="' + data[i]['id'] + '" >&nbsp;<label for="radio' + i + '">' + data[i]['rolename'] + '</label></div>');

	        		}

	        	}

	        },
	        // 失败回调
	        'error' : function(){

	            $("#roleId").empty();

	            $("#roleId").append('<p style="color:red;font-weight:bold;">您的角色权限无法对管理员此进行角色权限修改操作！</p>');

	            $("#saveRole").remove();
	        }

	    });

	});

	
</script>
 </html>