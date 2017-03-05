<?php 
namespace Home\Controller;

class OrdersController extends CommonController
{
	
	public function index()
	{
		$address = D('useraddress');

		$list = $address->where('userid='.$_SESSION['users']['id'])->select();
		
		$id = I('get.id');

		$product = D('products');

		$data = $product->find($id);



		$fineness = ['非全新','全新'];

		$deliver = [1=>'快递',2=>'当面交易'];

		$data['fineness'] = $fineness[$data['fineness']];

		$data['deliver'] = $deliver[$data['deliver']];

		if($data['userid'] == $_SESSION['users']['id'] ){

			$this->error('不能购买自己发布的闲置！');

		}
		

		$this->assign('data',$data);

		$this->assign('list',$list);


		$this->display();

	}


	public function add_order()
	{

		if(empty($_POST['addr'])){

			$this->error('请选择地址');

		}

		$order = D('orders');

		$res = $order->add_order();

		if($res == 1){

			$this->success('下单成功',U('Home/Person/myorders'),1);

		}else{

			$this->error($res);

		}

	}

	public function com_ajax()
	{

		$id = I('post.id');

		$pid =I('post.pid');

		$order = D('orders');

		$res = $order->where('id='.$id)->save(['status'=>2]);

		if($res){
			$product = D('products');
			
			if($product->where('id='.$pid)->save(['status'=>3])){
					echo 1;
				}
			

		}else{

			echo '';

		}
	}


	public function cancel_ajax()
	{

		$id = I('post.id');

		$pid =I('post.pid');

		$order = D('orders');

		$res = $order->where('id='.$id)->save(['status'=>0]);

		if($res){
			$product = D('products');
			
			if($product->where('id='.$pid)->save(['status'=>1])){
					echo 1;
				}
			

		}else{

			echo '';

		}
	}


}
