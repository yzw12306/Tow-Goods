<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
	<link rel="stylesheet" href="/project/twogoods/Public/css/header_nav_footer.css">
	<link rel="stylesheet" href="/project/twogoods/Public/css/home_index.css">
	<script src="/project/twogoods/Public/js/jquery-2.1.3.min.js"></script>
	<script src="/project/twogoods/Public/js/jquery.edslider.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="/project/twogoods/Public/Home_images/icon.png">
	<!-- 轮播图控制图标样式 -->
	<link rel="stylesheet" href="/project/twogoods/Public/css/edslider.css">
</head>
<body>
	<!-- 头部文件加载开始 -->
	<?php echo W('Cate/menu');?>
	<!-- 头部文件加载结束 -->

	<div class="clear"></div>
	<!-- 搜索栏开始 -->
	<div class="search">
		<div class="search_main">
			<div class="search_menu"><a href="<?php echo U('Home/Products/index');?>">全部商品分类</a></div>
			<div id="search_box">
				<form action="<?php echo U('Home/Index/find');?>" method="get">
					<input type="text" name="search" placeholder="请输入搜索内容">
					<button class="search_button" type="submit">搜索</button>
				</form>
			</div>
		</div>
	</div>
	<!-- 搜索栏模块结束 -->

	<!-- 网站内容模块 -->
	<div class="content">
		<!-- 菜单栏、轮播图、公告 -->
		<div class="first_glance">
			<!-- 菜单栏 -->
			<div class="item">
				<div class="item_menu">
					<ul>
						<?php if(is_array($data)): foreach($data as $key=>$val): ?><li>
									<a href="<?php echo U('Home/Products/index',['id'=>$val['id']]);?>" style="font-size: 17px"><?php echo ($val['name']); ?></a>
									<?php if(is_array($val['list'])): foreach($val['list'] as $key=>$v): ?><a href="<?php echo U('Home/Products/index',['id'=>$v['id']]);?>"><?php echo ($v['name']); ?></a><?php endforeach; endif; ?>
								</li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div>
            <!-- 菜单栏结束 -->
            
			<!-- 轮播图 -->
			<div class="index_slider">
				<ul class="slider">
					<?php if(is_array($img)): foreach($img as $key=>$val): if($key < 5): ?><li><a href="<?php echo ($val['piclink']); ?>"><img src="/project/twogoods/Public/Uploads/<?php echo ($val['picture']); ?>" width="566"></a></li><?php endif; endforeach; endif; ?>
				</ul>
			</div>
			<div class="left_main">
				<!-- 发布按钮 -->
				<div class="pub_btn">
					<div class="pub">
						<a href="<?php echo U('Home/Person/Products');?>">
		                    <span class="main_title">发布闲置</span>
		                    <span class="subtitle">闲置换钱 快速出手</span>
		                </a>
					</div>
					<div class="pub">
						<a href="<?php echo U('Home/Person/myorders');?>">
		                    <span class="main_title">订单中心</span>
		                    <span class="subtitle">查看已买到的宝贝</span>
		                </a>
					</div>
				</div>

				<!-- 公告 -->
				<div class="notice">
					<p class="aa">
						<span style="font-size: 18px;font-weight: 700;">公告：</span>
						<span><?php echo ($notice[0]['content']); ?></span>
					</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- 猜你喜欢 -->
		<div class="what_you_like">
			<div class="you_may_like col">
		        <div class="avatar">
					<img src="/project/twogoods/Public/Uploads/Head_pic/<?php echo ($_SESSION['users']['picture'] ? $_SESSION['users']['picture'] : $headpic); ?>" width="200px">
		        </div>
				<!-- 左边登录窗口，还有推荐关键字 -->
	    		<p class="foreword">
					<?php if(!empty($_SESSION['users'])): ?>Hello <?php echo ($_SESSION['users']['username']); ?>!!!
					<?php else: ?>
						Hi，请先<a href="<?php echo U('Home/Login/login');?>" target="_blank" class="login">登录</a>吧！<br>这里有更多你感兴趣的！<?php endif; ?>
	    		</p>
	    	    <div class="tag-cloud">
	            	<span class="placeholder"></span>
	    			<a href="<?php echo U('Home/Products/index',['id' => 11]);?>" target="_blank">手机</a>
	    			<a href="<?php echo U('Home/Products/index',['id' => 21]);?>" target="_blank">课本	</a>
	    			<a href="<?php echo U('Home/Products/index',['id' => 35]);?>" target="_blank">电风扇</a>
	    			<a href="<?php echo U('Home/Products/index',['id' => 45]);?>" target="_blank">架子</a>
	    			<a href="<?php echo U('Home/Products/index',['id' => 33]);?>" target="_blank">洗衣机</a>
	    			<a href="<?php echo U('Home/Products/index',['id' => 13]);?>" target="_blank">相机</a>
				</div>
	    	</div>
			<!-- 推荐你喜欢的商品 -->
	    	<div class="new-items col">
				<!-- 栏目 -->
				<div class="hd">
		            <ul class="item-type">
		                <li class="selected" id="hot">热门关注</li>
		                <li id="new">新品上传</li>
		            </ul>
		        </div>
		        <div class="clear"></div>
				<!-- 商品列表 -->
		        <div class="bd">
		            <div class="item-list" id="aa" style="display: block;">
		                <div class="reload" id="hot_change"><b></b>换一批</div>
	                	<ul>
		                	<?php if(is_array($hot)): foreach($hot as $key=>$val): ?><li class="item">
		                            <div class="item-pic sh-pic">
		                                <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                    <img class="J_ItemPic" src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>" width="160px" height="160px">
		                                </a>
		                            </div>
		                            <p class="title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
		                        </li><?php endforeach; endif; ?>
	    				</ul>
		            </div>
		            <div class="item-list" id="bb" style="display: none;">
		                <div class="reload" id="new_change"><b></b>换一批</div>
	                	<ul>
	    					<?php if(is_array($new)): foreach($new as $key=>$val): ?><li class="item aaa">
		                            <div class="item-pic sh-pic bbb">
		                                <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                    <img class="J_ItemPic" src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>" width="160px" height="160px">
		                                </a>
		                            </div>
		                            <p class="title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
		                        </li><?php endforeach; endif; ?>
	    				</ul>
		            </div>
		        </div>
                <!-- 猜你喜欢，商品列表结束 -->
                
		        <div class="clear"></div>
	    	</div>            
    	</div>
        <!-- 猜你喜欢模块结束 -->
        
        <!-- 闲置列表 -->
		<div id="goods_item">
			<!-- 数码闲置 -->
        	<div class="item_digital">
				<span><a href="">闲置数码</a></span>
				<div class="item_digital_list">
				
					<!-- 点击量最高的 -->
					<?php if(is_array($digital)): foreach($digital as $key=>$val): if($key == 0): ?><div class="goods_a">
								<div class="digital_img">
		                            <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                <img src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>">
		                            </a>
		                        </div>
		                        <p class="goods_title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
		                        <div class="price-block">
			                        <p class="price">
			                        	<b>¥</b><em><?php echo ($val['price']); ?></em>
			                        </p>
		                        </div>
							</div><?php endif; endforeach; endif; ?>
					<div class="goods_b">
						<?php if(is_array($digital)): foreach($digital as $key=>$val): if($key == 0): else: ?>
								<div class="goods_c">
									<div class="goods_c_img">
			                            <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
			                                <img src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>">
			                            </a>
			                        </div>
			                        <p class="goods_c_title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
			                        <div class="price-block">
				                        <p class="price">
				                        	<b>¥</b><em><?php echo ($val['price']); ?></em>
				                        </p>
			                        </div>
								</div><?php endif; endforeach; endif; ?>
					</div>
				</div>
        	</div>
			<!-- 数码闲置 -->

			<!-- 书籍资料 -->
        	<div class="item_books">
				<span><a href="">书籍资料</a></span>
				<div class="item_books_list">
					<?php if(is_array($books)): foreach($books as $key=>$val): if($key == 0): ?><div class="goods_a">
								<div class="digital_img">
		                            <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                <img src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>">
		                            </a>
		                        </div>
		                        <p class="goods_title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
		                        <div class="price-block">
			                        <p class="price">
			                        	<b>¥</b><em><?php echo ($val['price']); ?></em>
			                        </p>
		                        </div>
							</div><?php endif; endforeach; endif; ?>

					<div class="goods_b">
					<?php if(is_array($books)): foreach($books as $key=>$val): if($key == 0): else: ?>
							<div class="goods_c">
								<div class="goods_c_img">
		                            <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                <img src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>">
		                            </a>
		                        </div>
		                        <p class="goods_c_title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val[goods]); ?></a></p>
		                        <div class="price-block">
			                        <p class="price">
			                        	<b>¥</b><em><?php echo ($val['price']); ?></em>
			                        </p>
		                        </div>
							</div><?php endif; endforeach; endif; ?>

					</div>					
				</div>
        	</div>
			<!-- 书籍资料模板结束 -->

        	<!-- 运动户外 -->
        	<div class="item_sp">
				<span><a href="">运动户外</a></span>
				<div class="item_sp_list">
					<?php if(is_array($outdoor)): foreach($outdoor as $key=>$val): if($key == 0): ?><div class="goods_a">
								<div class="digital_img">
		                            <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                <img src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>">
		                            </a>
		                        </div>
		                        <p class="goods_title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
		                        <div class="price-block">
			                        <p class="price">
			                        	<b>¥</b><em><?php echo ($val['price']); ?></em>
			                        </p>
		                        </div>
							</div><?php endif; endforeach; endif; ?>
					<div class="goods_b">
					<?php if(is_array($outdoor)): foreach($outdoor as $key=>$val): if($key == 0): else: ?>
							<div class="goods_c">
								<div class="goods_c_img">
		                            <a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>" target="_blank">
		                                <img src="/project/twogoods/Public/Uploads/<?php echo ($val['picname']); ?>">
		                            </a>
		                        </div>
		                        <p class="goods_c_title"><a href="<?php echo U('Home/Details/Index',['id'=>$val['id']]);?>"><?php echo ($val['goods']); ?></a></p>
		                        <div class="price-block">
			                        <p class="price">
			                        	<b>¥</b><em><?php echo ($val['price']); ?></em>
			                        </p>
		                        </div>
							</div><?php endif; endforeach; endif; ?>

					</div>
				</div>
        	</div>
        </div>
	</div>
	<div class="clear"></div>
	<!-- 内容部分结束 -->


	<!-- 底部文件加载 -->
	<?php echo W("Cate/foot");?>


</body>
	<script type="text/javascript">
		$(document).ready(function(){
			//Call plugin
			$('.slider').edslider({
				width : '100%',
				height: '290',
			});
		});

		$('.item-type li').hover(
			function () {
				$(this).css('cursor','pointer');
			}

		);

		$('#hot').click(function(){
			$(this).addClass('selected');
			$('#aa').css('display','block');
			$('#bb').css('display','none');
			$('#new').removeClass('selected');
		});
		$('#new').click(function(){
			$(this).addClass('selected');
			$('#bb').css('display','block');
			$('#aa').css('display','none');
			$('#hot').removeClass('selected');
		});

		var i = 2;
		$('#hot_change').click(function(){
				i++;
				console.log(i);
			$.get('<?php echo U('Home/Index/hot_ajax');?>',{'num':i},function(data){
				console.log(data);
				for (var j = 0; j < data.length; j++) {
					$('.item p a:eq('+j+')').html(data[j].goods);
					var url = "<?php echo U('Home/Details/index');?>?id=" + data[j].id;					
					$('.item-pic a:eq('+j+')').attr('href',"<?php echo U('Home/Details/index');?>?id=" + data[j].id);
					$('.item-pic a img:eq('+j+')').attr('src',"/project/twogoods/Public/Uploads/"+data[j].picname);					
				};
			});
		});

		var q = 2; 
		$('#new_change').click(function(){
			q++;	
			// console.log(q);
			$.get('<?php echo U('Home/Index/new_ajax');?>',{'hh':q},function(list){
				
				for (var j = 0; j < list.length; j++) {
					$('.aaa p a:eq('+j+')').html(list[j].goods);
					var url = "<?php echo U('Home/Details/index');?>?id=" + list[j].id;
					$('.bbb a:eq('+j+')').attr('href',"<?php echo U('Home/Details/index');?>?id=" + list[j].id);
					$('.bbb a img:eq('+j+')').attr('src',"/project/twogoods/Public/Uploads/" + list[j].picname);
					
				};			
			});

		});
		
	</script>
</html>