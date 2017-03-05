<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品列表</title>
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.masonry.js"></script>
	<script type="text/javascript" src="/SecondProject/TG/Public/js/jquery.infinitescroll.js"></script>	
	<script type="text/javascript" src="/SecondProject/TG/Public/js/bootstrap.min.js"></script>	

	<link rel="stylesheet" href="/SecondProject/TG/Public/css/bootstrap.min.css">	
	<link rel="stylesheet" href="/SecondProject/TG/Public/css/main.css">
	<link rel="stylesheet" href="/SecondProject/TG/Public/css/header_nav_footer.css">
	<link rel="shortcut icon" type="image/x-icon" href="/SecondProject/TG/Public/images/icon.png">
	<script type="text/javascript" src="/SecondProject/TG/Public/js/shop.js"></script>
</head>
<body>

	<?php echo W('Cate/menu');?>

<div class="content">
	<!-- 当前位置 -->
	<div class="crumbs-container">
	    <div class="crumbs">
	        <em class="crumbs-title">个人闲置：</em>
				<a href="#" class="crumbs-nav">全部</a>
				<span class="pipe-gt">&gt;</span>
				<span class="cur-category">手机</span>
		</div>                        	
	</div>
	<!-- 二级导航 -->
	<div class="category-filter-container sh-roundbox">
	    <div class="category-filter-wrapper">
	        <div id="J_CategoryFilters" class="category-filters">
				<div class="category-list J_HiddenArea">
				    <ul class="J_HiddenAreaContent clearfix">
						<li>
							<a href="#" title="手机">手机</a>
				            <span>(166.3万)</span>
				        </li>
						<li>
				            <a href="#" title="配件">配件</a>
				            <span>(80.8万)</span>
				        </li>
				    </ul>
				</div>
	        </div>
	    </div>
	    <div class="clear"></div>
	</div>

	<!-- 排序搜索 -->	
		<div class="search_sort">
			<div class="sort">
				<!-- <a href="#" role="button"><span class="fs_tit">价格</span><em class="fs-up"><i class="arrow-top"></i><i class="arrow-bottom"></i></em></a> -->
				<button id="togglePirce" role="button"><span class="fs_tit">价格</span><em class="fs-up"><i class="arrow-top"></i><i class="arrow-bottom"></i></em></button>
				<a href="#" role="button">最新发布<em class="fs-up"><i class="arrow"></i></em></a>
			</div>
			<div class="search">
				<div class="col-md-9 col-md-offset-2">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="请输入你想要搜索的内容">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
			</div>
		</div>	
	<!-- 排序搜索结束 -->


	<!-- 商品列表 -->
	<div class="demo clearfix">
		
		<div class="item_list infinite_scroll">
		
			<?php if(is_array($list)): foreach($list as $key=>$val): ?><!-- 商品开始 -->
				<div class="item masonry_brick">
					<div class="item_t">
						<div class="item_pic">
							<a href=""><img width="210" height="285" alt="js lazyload实现网页图片延迟加载特效" src="/SecondProject/TG/Public/images/pic/01.jpg" /></a>
							<span class="price"><?php echo ($val['price']); ?></span>
							
						</div>
						<div class="title"><span>￥<?php echo ($val['goods']); ?></span></div>
					</div>
					<div class="item_b clearfix">
						<div class="items_likes fl">
							<a href="#" class="like_btn"></a>
							<em class="bold"><?php echo ($val['clicknum']); ?></em>
						</div>
						<div class="items_comment fr"><a href="#">评论</a><em class="bold">(0)</em></div>
					</div>
				</div>
				<!--商品结束--><?php endforeach; endif; ?>
		</div>
						
						
		<div id="more"><a href="page/2.html"></a></div>
						
		<div id="page" class="page" style="display:none;">
			<div class="page_num">
				<span class="unprev"></span>
				<span class="current">1</span>
				<a href="#">&nbsp;2&nbsp;</a>
				<a href="#">&nbsp;3&nbsp;</a>
				<a href="#">&nbsp;4&nbsp;</a>
				<a href="#">&nbsp;5&nbsp;</a>
				<span class="etc"></span>
				<a href="#">12</a>
				<a href="#" class="next"></a>
			</div>
		</div>
	</div>
</div>

	<!-- 底部文件加载开始 -->
	<?php echo W("Cate/foot");?>

	<div style="display:none;" id="gotopbtn" class="to_top"><a title="返回顶部" href="javascript:void(0);"></a></div>
</body>
<script type="text/javascript">

	$("#togglePirce").toggle(function(){

			$.ajax({

		        // 请求的地址
		        'url' : "<?php echo U('Home/List/index');?>",

		        // 是否异步
		        'async' : true,

		        'data' :{

		        		'price': 'desc'

				    },

		        // 数据类型
		        'dataType' : 'json',

		        // 请求方式
		        'type' : 'GET',
		        
			});

			// $.get(<?php echo U("Home/List/index");?>, {'price': 'asc'}, "json");

		},function(){

			$.ajax({

		        // 请求的地址
		        'url' : "<?php echo U('Home/List/index');?>",

		        // 是否异步
		        'async' : true,

		        'data' :{

		        		'price': 'asc'

				    },

		        // 数据类型
		        'dataType' : 'json',

		        // 请求方式
		        'type' : 'GET',
		        
			});

		}

	);

</script>
</html>