<?php 
	namespace Home\Controller;

	/**
	* 
	*/
	class MessagesController extends CommonController
	{
		
		public function index()
		{
			$msg = D('messages');

			$id = I('get.productid');

			$res = $msg -> do_msg();

			if($res){

				$this -> error($res);

			}else{

				$this -> success('添加成功',U('Home/Details/index',['id' => $id]),1);

			}

		}

		public function reply()
		{
			$msg = D('messages');

			$id = I('get.productid');

			$res = $msg -> do_reply();

			if($res){

				$this -> error($res);

			}else{

				$this -> success('添加成功',U('Home/Details/index',['id' => $id]),1);

			}


		}
	}