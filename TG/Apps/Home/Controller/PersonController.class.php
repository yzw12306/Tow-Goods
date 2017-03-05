<?php 
namespace Home\Controller;

class PersonController extends CommonController
{
	//个人中心展示页
	public function index()
	{
		$user = $_SESSION['users'];

		$user['logintime'] = $user['logintime'] == 0 ? date('Y-m-d H:i:s',$user['addtime']) : date('Y-m-d H:i:s',$user['logintime']) ; 

		$user['birth'] = $user['birth'] == '1990-01' ? '无': date('Y-m-d',$user['birth']) ; 

		$this->assign('users',$user);

		$this->assign('default','header.jpg');

		$this->display();
	}

	public function sell_ajax(){

		$map['status'] = ['eq',I('post.status')];

		$map['userid'] = ['eq',$_SESSION['users']['id']];

		$products = D('Products');

		$res = $products->where($map)->count();

		$this->ajaxReturn($res);
		
	}

	//个人首页显示 ‘我的订单’ 数量
	public function ord_ajax(){

		$map['status'] = ['eq',I('post.status')];

		$map['buyid'] = ['eq',$_SESSION['users']['id']];

		$products = D('orders');

		$res = $products->where($map)->count();

		$this->ajaxReturn($res);
		
	}

	//个人信息修改页面展示
	public function edit()
	{

		$user = $_SESSION['users'];

		$user['logintime'] = $user['logintime'] == 0 ? '无': date('Y-m-d H:i:s',$user['logintime']) ; 

		$user['birth'] = $user['birth'] == '1990-01' ? '无': date('Y-m-d',$user['birth']) ; 

		$this->assign('users',$user);

		$this->assign('default','header.jpg');

		$this->display();

	}

	//执行个人信息的修改
	public function do_edit()
	{
			
			$users = D('users');

			$data = $users->edit();
			
			if( is_array( $data ) ){

				$_SESSION['users'] = $data;

				header('location:'.U('Home/Person/index'));

			}else{

				$this->error( $data );

			}

		}

	//修改密码页面
	public function reset()
	{

		$this->assign('id',$_SESSION['users']['id']);

		$this->display();

	}

	//验证信息与执行密码重置
	public function do_reset()
	{

		$users = D('users');

		$res = $users->per_reset();

		if($res == '修改成功'){
			$this->success($res,U('Home/Person/index'),1);
		}else{
			$this->error($res,U('Home/Person/reset'),1);
		}

	}

	//展示个人地址管理页面
	public function address()
	{

		$address = D('useraddress');

		$data = $address->pro_address();

		$this->assign('data',$data);

		$this->display();

	}

	// 执行添加收货地址
	public function add_address()
	{
		
		$address = D('useraddress');

		$post = I('post.');

		$post['userid'] = $_SESSION['users']['id'];

		$post['addtime'] = time();

		if($address->create($post)){

			$res = $address->add();
			if($res){

				$this->success('添加成功',U('Home/Person/address'),1);

			}else{

				$this->error('添加失败',U('Home/Person/address'),1);

			}
			
		}else{

			$this->error($address->getError());

		}

	}


	//执行删除地址
	public function del_address()
	{

		$address = D('useraddress');

		$res = $address->del();

		if($res){
			header('location:'.U('Home/Person/address'));
		}else{
			$this->error('删除失败',U('Home/Person/address'),1);
		}

	}

	//编辑地址页面
	public function edit_address()
	{

		$address = D('useraddress');

		$data = $address->find(I('get.id'));

		$this->assign($data);

		$this->display();

	}

	//执行编辑
	public function doedit_address()
	{
		$address = D('useraddress');

		$res = $address->edit();

		if($res == 1|| $res == 0){

			header('location:'.U('Home/Person/address'));

		}else{
	
			$this->error($res,U('Home/Person/address'),1);
				
		}

	}

	//发布闲置
	public function products()
	{

		$this->display();

	}

	public function type_ajax()
	{

		$type = D('type');

		if(I('post.pid') == 'null'){

			return 0;

		}
		$data = $type->ajax();

		$this->ajaxReturn($data);

	}

	//执行发布闲置
	public function add_products()
	{
		$post = I('post.');

		$post['addtime'] = time();

		$post['userid'] = $_SESSION['users']['id'];

		//优先使用底层的类别
		if($post['t_typeid'] !== 'null'){

			$post['typeid'] = $post['t_typeid'];

		}elseif($post['s_typeid'] !== 'null'){

			$post['typeid'] = $post['s_typeid'];

		}elseif($post['f_typeid'] !== 'null'){

			$post['typeid'] = $post['f_typeid'];

		}

		$products = D('products');
		//添加上传的图片名
		$info = $products->upload();

		if(is_array($info)){

			$post['picname'] = $info['pic']['savename'];

		}else{

			$this->error($info,U('Home/Person/products'),1);

			return;
		}

		//自动验证
		if($products->create($post)){
			//执行添加
			$res = $products->add();

			if($res){

				$this->success('发布成功',U('Home/Person/my_products'),1);

			}else{

				$this->error('发布失败',U('Home/Person/products'),1);

			}
		}else{

			$this->error($products->getError());

		}

	}

	//显示 ‘我的闲置’
	public function my_products()
	{
		
		$products = D('products');

		$data = $products->my_products();

		if(empty($data['list'])){
			
			$data['list'] = 'null';

		}

		$message = D('messages');

		foreach($data['list'] as $key=>&$val){

			$val['mesnum'] = $message->where('productid='.$val['id'])->count();

		}

		$this->assign($data);

		$this->display();

	}

	//修改闲置商品状态的ajax
	public function state_ajax()
	{
		$products = D('products');

		$map['id'] = ['eq',I('post.status')];

		$data = $products->where($map)->select();

		$status = $data[0]['status'];

		if($status == 1){
			$list['status'] = 2;

		}elseif($status == 2){

			$list['status'] = 1;

		}

		$products->where($map)->save($list);

		$this->ajaxReturn($list['status']);

	}



	//修改 ‘我的闲置’ 中的商品信息
	public function edit_pro()
	{
		$products = D('products');

		$data = $products->where('id='.I('get.id'))->select();

		$this->assign($data[0]);

		$this->display();

	}

	//执行修改商品信息
	public function doedit_pro()
	{
		$post = I('post.');

		//优先使用底层的类别
		if($post['t_typeid'] !== 'null'){

			$post['typeid'] = $post['t_typeid'];

		}elseif($post['s_typeid'] !== 'null'){

			$post['typeid'] = $post['s_typeid'];

		}elseif($post['f_typeid'] !== 'null'){

			$post['typeid'] = $post['f_typeid'];

		}

		$products = D('products');
		//添加上传的图片名
		$info = $products->upload();

		if(is_array($info)){

			$post['picname'] = $info['pic']['savename'];

			unlink('./Public/Uploads/Products_pic/'.$post['oldpic']);
		}

		//自动验证
		if($products->create($post)){
			//执行添加
			$res = $products->where('id='.$post['id'])->save();

			if($res){

				$this->success('编辑成功',U('Home/Person/my_products'),1);

			}else{

				header('location:'.U('Home/Person/my_products'));

			}
		}else{

			$this->error($products->getError());

		}
	}


	//我的订单展示页
	public function myorders()
	{
		$order = D('orders');

		$map['buyid'] = ['eq',$_SESSION['users']['id']];

		if(!empty($_GET['status'])){

			$get = I('get.status');

			$map['status'] = ['eq',$get];

		}

		$list = $order->where($map)->select();

		if(empty($list)){
			
			$list = 'null';

		}

		$product = D('products');

		$user = D('users');

		$eva = D('evaluate');

		foreach($list as $key=>&$val){

			$val['ordernum'] = date('Ymd',$val['addtime']).sprintf('%04d',$val['id']);

			$val['addtime'] = date('Y-m-d',$val['addtime']);

			$prolist = $product->find($val['productid']);

			$val['initprice'] = $prolist['initprice'];

			$val['picname'] = $prolist['picname'];

			$userlist = $user->find($val['saleid']);

			$val['salename'] = $userlist['username'];

			$evalist = $eva->where('orderid='.$val['id'])->select();

			$val['score'] = $evalist[0]['score'];

		}

		$this->assign('list',$list);

		$this->display();

	}

	public function collect()
	{



		$data = M()->table(array('tg_products'=>'pd','tg_collection'=>'cl'))->field('pd.id,pd.userid,pd.initprice,pd.price,pd.goods,pd.picname')->where('pd.id=cl.productid and cl.userid='.$_SESSION['users']['id'])->select();

		$user = D('users');

		$userlist = $user->select();

		$temp = [];

		foreach($userlist as $key => $val){

			$temp[$val['id']] = $val['username'];

		}

		foreach($data as $key => &$val){

			$val['userid'] = $temp[$val['userid']];


		}


		$this->assign('list',$data);

		$this->display();

	}


}
