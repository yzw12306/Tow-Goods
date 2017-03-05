<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品详情页</title>
	<link rel="stylesheet" href="/project/TG/Public/css/pgwslideshow.css">
	<link rel="stylesheet" href="/project/TG/Public/css/details.css">
	<link rel="stylesheet" href="/project/TG/Public/css/bootstrap.min.css">
	<link rel="stylesheet" href="/project/TG/Public/css/header_nav_footer.css">
	<script src="/project/TG/Public/js/jquery-2.1.3.min.js"></script>
	<script src="/project/TG/Public/js/pgwslideshow.js"></script>
	<script src="/project/TG/Public/js/bootstrap.min.js"></script>	
	<link rel="shortcut icon" type="image/x-icon" href="/project/TG/Public/Home_images/icon.png">
</head>
<body>
	<!-- 头部文件加载开始 -->
	<?php echo W('Cate/menu');?>
	<!-- 头部文件加载结束 -->

	<div class="detail_main">
		<p><a href="index.php" style="margin-right:5px;">首页</a>><span style="color:#959595;margin-left:5px;"><a href="<?php echo U('Home/Products/index');?>">全部商品</a></span></p>
		<div class="dtl_top">
			<div class="dtl_img col-md-6">
				<ul class="pgwSlideshow">
				    <li><img src="/project/TG/Public/Uploads/<?php echo ($list['picname']); ?>" ></li>
				    
				</ul>
			</div>
			<div class="col-md-5 col-md-offset-1 dtl_inf ">
				<h3><?php echo ($list['goods']); ?></h3>

				<div style="line-height: 40px;">原&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：
					<b>￥</b>
					<em style="color:#f40;font-size: 24px;"><del><?php echo ($list['initprice']); ?></del></em>
					<span style="color: #fc0;font-size:12px;margin-left: 10px;"><?php echo ($list['trade']); ?></span>
				</div>
				<div style="border-bottom: 1px solid #ccc;margin-top: 10px;"></div>
				<div style="line-height: 40px;">转卖价格：
					<b>￥</b>
					<em style="color:#f40;font-size: 24px;"><?php echo ($list['price']); ?></em>
				</div>
				<div style="line-height: 40px;">成&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;色：
					<span><?php echo ($list['fineness']); ?></span>
				</div>
				<div style="line-height: 40px;">联系方式：
					<span>
						<?php echo ($info['phone']); ?>
					</span>
				</div>
					<div class="btn-group" data-toggle="buttons" style="line-height: 40px;">
						<span style="display: block; float: left;">交易方式：</span>
						<label class="btn btn-default btn-xs" style="margin-top: 8px; margin-left: 3px;">
						    <input type="radio" name="deliver" id="option2" value="<?php echo ($list['deliver']); ?>" autocomplete="off"><?php echo ($list['deliver']); ?>
						</label>
					</div>
					<p style="padding-top: 10px;">添加时间：<?php echo ($list['addtime']); ?></p>
					<p style="padding-top: 10px;">浏览次数：<?php echo ($list['clicknum']); ?></p>
					<div style="margin-top: 40px; width: 60px;">
						<a class="btn btn-success btn-lg-9" style="width:200px;" href="<?php echo U('Home/orders/index',['id' => $list['id']]);?>">立即购买</a>
					</div>
				<div style="margin-top: 20px;"><span class="btn" id="collection"><i <?php echo ($collection == 0 ? '' : 'style="color:#f40"'); ?> class="glyphicon glyphicon-heart"></i> 收藏</span></div>
				<div class="user_info">
					<div class="user_hpic"><img src="/project/TG/Public/Uploads/Head_pic/<?php echo ($info['picture'] ? $info['picture'] : $img); ?>" alt="" width="60px" height="60px;"></div>
					<label for="userinfo">
					<div class="user_info_main">
						<span style="font-size: 18px;padding-left: 16px; overflow: hidden; width: 100px; white-space: nowrap; text-overflow: ellipsis;" tabindex="0" class="btn btn-md bs-docs-popover" id="userinfo" role="button" data-toggle="popover" data-trigger="focus" title="" data-html="true" data-content="<p>注册时间:<b style='color: #f40'><?php echo ($info['addtime']); ?>;</b></p><p>转卖笔数:<b style='color: #f40'><?php echo ($res); ?></b>;</p><p>最近登录:<b style='color: #f40'><?php echo ($info['logintime']); ?></b>;</p>" data-original-title="<?php echo ($info['username']); ?>"><?php echo ($info['username']); ?></span>
						<span style="padding-left: 20px; font-size: 12px;">用户积分：<b style="color: #f40"><?php echo ($info['secord']); ?></b></span>
					</div>
					</label>
				</div>

			</div>
		</div>

		<div class="clear"></div>
		<div class="dtl_content">
			<div class="col-md-8">
				<div class="content_nav">
					<ul>
						<li id="info" class="selected">产品信息</li>
						<li id="msg">留言</li>
						<li></li>
					</ul>
				</div>
				<div class="content_main" style="display: block;">
					<p><?php echo ($list['description']); ?></p>

					<img src="/project/TG/Public/Uploads/<?php echo ($list['picname']); ?>" width="600px">
				</div>

				<!-- 商品留言 -->
				<div class="content_msg" style="display: none">
					<div class="msg_list">

						<!-- 内容显示 -->
						<?php if(is_array($messages)): foreach($messages as $key=>$val): ?><div class="cmt-item">
						        <span class="cmt-reply-user">
						            <img src="/project/TG/Public/Uploads/Head_pic/<?php echo ($val['picname'] ? $val['picname'] : $img); ?>" width="30px" height="30px" alt="" >
						        </span>
						        <div class="cmt-cont-wrap">
						            <p class="cmt-cont">
						                <span class="cmt-user-name"><?php echo ($val['fromuser']); ?>
											<?php if($val['floor'] != 0): ?><span style="margin-right: 5px;">回复</span><?php echo ($val['touser']); endif; ?>
						                :</span>
						                <span class="cmt-cont-text"><?php echo ($val['message']); ?></span>
						            </p>
						            <p class="cmt-date"><?php echo ($val['addtime']); ?><span class="btn" data-toggle="modal" data-target="#<?php echo ($val['id']); ?>_myModel" style="float:right;padding-right: 20px;<?php echo ($_SESSION['users'] ? '' : 'display:none'); ?>" >回复</span></p>
						            <div class="clear"></div>
									
									<!-- 留言模态框 -->
									<div class="modal fade" id="<?php echo ($val['id']); ?>_myModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													<h4 class="modal-title" id="myModalLabel">留言</h4>
												</div>

												<form action="<?php echo U('Home/Messages/reply',['id'=>$val['id'],'productid'=>$val['productid'],'floor'=>$key]);?>" method="get">
													<div class="modal-body">
														<textarea class="form-control" name="message" rows="3"></textarea>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary">提交</button>
													</div>
												</form>
											</div>
										</div>
									</div>
									<!-- 模态框结束 -->

						        </div>					        
						    </div><?php endforeach; endif; ?>

					    <!-- 内容输入 -->
					    <div class="sent_msg">
					    	<form action="<?php echo U('Home/Messages/index',['productid'=> $list['id'],'touser'=>$list['userid']]);?>" method="get">
								<textarea class="form-control" name="message" rows="3"></textarea>
								<button type="submit" class="btn btn-success" style="float: right;margin-top: 10px;margin-right: 10px;">提交</button>
							</form>
				        </div>
					</div>
				</div>
			</div>
			<div class="col-md-4" <?php echo ($products ? 'style="display:block"' : 'style="display:none"'); ?>>
				<div class="user_product">
					<div class="user_product_header">
						<h4>卖家其它商品</h4>
					</div>
					<div class="user_product_main">
						<div class="user_product_content">
						<?php if(is_array($products)): foreach($products as $key=>$val): ?><div class="product_content">
								<a href="<?php echo U('Home/Details/index',['id' => $val['id']]);?>"><img src="/project/TG/Public/Uploads/<?php echo ($val['picname']); ?>" width="100px"></a>
								<div class="wrapper">
									<h5><a href="<?php echo U('Home/Details/index',['id' => $val['id']]);?>"><?php echo ($val['goods']); ?></a></h5>
									<div class="product_price">￥<?php echo ($val['price']); ?></div>
								</div>
							</div><?php endforeach; endif; ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>

			<div class="col-md-4 hot_sell" style="float: right;">
				<div class="user_product">
					<div class="user_product_header">
						<h4>热门商品</h4>
					</div>
					<div class="user_product_main">
						<div class="user_product_content">
						<?php if(is_array($hotsell)): foreach($hotsell as $key=>$val): ?><div class="product_content">
								<a href="<?php echo U('Home/Details/index',['id' => $val['id']]);?>"><img src="/project/TG/Public/Uploads/<?php echo ($val['picname']); ?>" width="100px"></a>
								<div class="wrapper">
									<h5><a href="<?php echo U('Home/Details/index',['id' => $val['id']]);?>"><?php echo ($val['goods']); ?></a></h5>
									<div class="product_price">￥<?php echo ($val['price']); ?></div>
								</div>
							</div><?php endforeach; endif; ?>
						</div>
					</div>
				</div>				
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>


	<!-- 底部文件加载 -->
	<?php echo W("Cate/foot");?>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.pgwSlideshow').pgwSlideshow({
	    	transitionEffect:'fading',
	    	autoSlide:true,
	    	maxHeight:500,
	    	displayControls:false
	    });
	});

	$("#msg").click(function(){
		$(this).addClass('selected');
		$('.content_msg').css('display','block');
		$('.content_main').css('display','none');
		$('#info').removeClass('selected');
	});

	$("#info").click(function(){
		$(this).addClass('selected');
		$('.content_main').css('display','block');
		$('.content_msg').css('display','none');
		$('#msg').removeClass('selected');
	});	

	$("#collection").click(function(){
			var pid = '<?php echo ($list['id']); ?>';
			$.get("<?php echo U('Home/Collection/status');?>",{'id':pid},function(data){
				console.log(data);
				if(data){
					if(data == 1){
						$('#collection i').css('color','#f40');
					}else{
						window.location.href="<?php echo U('Home/Login/login');?>";
					}
					
				}else{
					$('#collection i').css('color','');
				}
			});
		});

	$('#userinfo').popover('hidden');
	
</script>