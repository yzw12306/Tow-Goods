<?php 
	namespace Home\Controller;

	/**
	* 
	*/
	class DetailsController extends EmptyController
	{
		
		public function index()
		{

			$products = D('products');			

			// 通过ProductModel方法处理商品信息数据

			$list = $products -> do_details();

			$data['list'] = $list;

			$map['userid'] = $list['userid'];

			//统计出该卖家所有出售商品的数量
			$res = $products -> where($map) -> count();

			$data['res'] = $res;

			$users = D('users');

			// 通过UserModel方法处理用户信息
			$info = $users -> do_details($list['userid']);

			$data['info'] = $info;

			$col = D('collection');

			// 获取详情页ajax提交上来所要收藏的商品id
			$map['productid'] = I('get.id');

			//通过session获取所登录的用户ID
			$map['userid'] = $_SESSION['users']['id'];

			//统计数据库里面该用户是否收藏着该商品
			$data['collection'] = $col -> where($map) -> count();

			// 引用MessageModel分配展示数据
			$msg = D('messages');

			$messages = $msg -> show_msg();			

			$data['messages'] = $messages;

			$data['img'] = "header.jpg";

			$where['userid'] = $list['userid'];

			$where['status'] = 1;
			// 展示商品卖家在售的商品
			$product = $products -> where($where) -> limit(3) -> select();

			$data['products'] = $product;

			// 热门产品展示分配
			$hotsell = $products -> where('status=1') -> order('clicknum desc') -> limit(3) -> select();

			$data['hotsell'] = $hotsell;

			$this -> assign($data);

			$this -> display();

		}

	}