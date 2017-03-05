<?php 
	namespace Admin\Controller;

	/**
	* 
	*/
	class OrdersController extends EmptyController
	{
		
		public function index()
		{
			$orders = D('orders');

			// 调用OrdersModel方法
			$data = $orders -> do_index();

			// 分配前台显示数据
			$this -> assign($data);
			
			$this -> display();	
		}

		public function status()
		{
			$orders = D('orders');

			$res = $orders -> do_status();

			if($res){

				$this -> success('状态修改成功');
			
			}else{

				$this -> error('状态修改失败');

			}			

		}
	}