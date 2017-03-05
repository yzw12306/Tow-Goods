<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品列表</title>
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.masonry.js"></script>
	<!-- <script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.infinitescroll.js"></script>	 -->
	<script type="text/javascript" src="/SecondProject/TG/Public/js/bootstrap.min.js"></script>	

	<link rel="stylesheet" href="/SecondProject/TG/Public/css/bootstrap.min.css">	
	<link rel="stylesheet" href="/SecondProject/TG/Public/css/main.css">
	<link rel="stylesheet" href="/SecondProject/TG/Public/css/header_nav_footer.css">
	<link rel="shortcut icon" type="image/x-icon" href="/SecondProject/TG/Public/Home_images/icon.png">
	<script type="text/javascript" src="/SecondProject/TG/Public/js/shop.js"></script>

</head>
<body>

	<?php echo W('Cate/menu');?>

<div class="content">
	<!-- 当前位置 -->
	<div class="crumbs-container">
	    <div class="crumbs">
	        <em class="crumbs-title">个人闲置：</em>
				<a href="<?php echo U('Home/Products/index');?>" class="crumbs-nav">全部</a>
				 <?php if(is_array($typepid)): foreach($typepid as $key=>$val): ?><span class="pipe-gt">&gt;</span>
					<a href="<?php echo U('Home/Products/index', ['id' => $val['id']]);?>" title=""><span class="cur-category"><?php echo ($val['name']); ?></span></a><?php endforeach; endif; ?>
				<!-- <span class="pipe-gt">&gt;</span>
				<span class="cur-category">手机</span> -->
		</div>                        	
	</div>
	<!-- 二级导航 -->
	<?php if($type != null): ?><div class="category-filter-container sh-roundbox">
		    <div class="category-filter-wrapper">
		        <div id="J_CategoryFilters" class="category-filters">
					<div class="category-list J_HiddenArea">
					    <ul class="J_HiddenAreaContent clearfix">
					    <?php if(is_array($type)): foreach($type as $key=>$val): ?><li>
								<a href="<?php echo U('Home/Products/index', ['id' => $val['id']]);?>" title=""><?php echo ($val['name']); ?></a>
							</li><?php endforeach; endif; ?>
					    </ul>
					</div>
		        </div>
		    </div>
		    <div class="clear"></div>
		</div><?php endif; ?>
	<!-- 排序搜索 -->	
		<div class="search_sort">
			<form action="<?php echo U('Home/Products/index');?>" method="get">
				<input type="hidden" name="id" value="<?php echo ($id); ?>">
				<div class="sort">
	                <a href="<?php echo U('Home/Products/Index', ['clicknum' => 'desc','id' => $id, 'search' => $search]);?>" role="button">人气排序<em class="fs-up"><i class="arrow"></i></em></a>	            
	                <a href="<?php echo U('Home/Products/Index', ['price' => 'desc', 'id' => $id, 'search' => $search]);?>" role="button"><span class="fs_tit">价格从高到低</span><em class="fs-up"><i class="arrow-top"></i><i class="arrow-bottom"></i></em></a>
	                <a href="<?php echo U('Home/Products/Index', ['price' => 'asc', 'id' => $id, 'search' => $search]);?>" role="button"><span class="fs_tit">价格从低到高</span><em class="fs-up"><i class="arrow-top"></i><i class="arrow-bottom"></i></em></a>
	                <span style="float:left;">&nbsp;&nbsp;&nbsp;</span>
					<input type="text" size="5" name="price1" value="<?php echo ($price1); ?>" placeholder="¥">
					<span style="float:left;line-height: 30px">&nbsp;-&nbsp;</span>
					<input type="text"  size="5" name="price2" value="<?php echo ($price2); ?>" placeholder="¥">
					<input type="submit" value="确定">			
				</div>
				<!-- 商品搜索 -->
				<div class="search">
					<div class="col-md-9 col-md-offset-2">
						<div class="input-group">						
							<input type="text" class="form-control" name="search" value="<?php echo ($search); ?>" placeholder="请输入你想要搜索的内容">
							<span class="input-group-btn">
								<input type="submit" class="btn btn-default" value="搜索">
								<!-- <button class="btn btn-default" type="button">Go!</button> -->
							</span>						
						</div><!-- /input-group -->					
					</div><!-- /.col-lg-6 -->
				</div>
			</form>
		</div>	
	<!-- 排序搜索结束 -->


	<!-- 商品列表 -->
	<div class="demo clearfix">
		
		<div class="item_list infinite_scroll">
		
			<?php if(is_array($list)): foreach($list as $key=>$val): ?><!-- 商品开始 -->
				<div class="item masonry_brick">
					<div class="item_t">
						<div class="item_pic">
							<a href="<?php echo U('Home/Details/Index', ['id' => $val['id']]);?>"><img width="210" alt="抱歉！图片加载失败！" src="/SecondProject/TG/Public/uploads/<?php echo ($val['picname']); ?>" /></a>
							<strong class="price" style="color:#f40;font-size:18px">￥<?php echo ($val['price']); ?></strong>
							
						</div>
						<div class="title"><a href="<?php echo U('Home/Details/Index', ['id' => $val['id']]);?>"><span style="font-weight:bold"><?php echo ($val['goods']); ?></span>&nbsp;&nbsp;&nbsp;<span><?php echo ($val['description']); ?></span></a></div>
					</div>
					<div class="item_b clearfix">
						<div class="items_likes fl">
							<a <?php echo ($val['collected'] ? 'class="like_btn_clicked"' : 'class="like_btn"'); ?> href="javascript:void(0);"onclick="collected(this, <?php echo ($val['id']); ?>);"></a>
							<em class="bold"><img src="/SecondProject/TG/Public/Home_images/pointer.png">&nbsp;<?php echo ($val['clicknum']); ?></em>
						</div>
						<div class="items_comment fr"><span>留言</span><em class="bold">(<?php echo ($val['messagenum']); ?>)</em></div>
					</div>
				</div>
				<!--商品结束--><?php endforeach; endif; ?>
		</div>
			
				
						
		<div id="more"><a href="page/2.html"></a></div>
		<!-- 页码开始 -->
		<center>
				<div id="btnBox">
		 			<?php echo ($show); ?>
		 		</div>	
	 	</center>
		<!-- 页码结束 -->
		
	</div>
</div>

	<!-- 底部文件加载开始 -->
	<?php echo W("Cate/foot");?>

	<div style="display:none;" id="gotopbtn" class="to_top"><a title="返回顶部" href="javascript:void(0);"></a></div>

</body>
<script type="text/javascript">

	// 将数字按钮进行包裹
	$('#btnBox').children().children().unwrap().wrap('<li></li>').parent().wrapAll('<ul class="pagination"></ul>');
	// 给当前页码高亮显示
	$('#btnBox span').parent().addClass('active');	

	//收藏商品调用ajax函数发送get请求
	function collected(e, id)
	{

		$.ajax({
			// 请求的地址
	        'url' : "<?php echo U('Home/Collection/status');?>",

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

	        	if(data){

	        		$(e).removeClass();
	        		$(e).addClass("like_btn_clicked");

	        	}else{

	        		$(e).removeClass();
	        		$(e).addClass("like_btn");

	        	}

	        }
		});

	}

</script>
</html>