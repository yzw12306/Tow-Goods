<?php 
	namespace Admin\Controller;

	/**
	* 
	*/
	class MessagesController extends EmptyController
	{
		
		public function index()
		{
			$msg = D('messages');

			$data = $msg -> do_index();

			$data['title'] = '留言列表';

			$this -> assign($data);

			$this -> display();
		}

		public function del()
		{
			$msg = D('messages');

			$res = $msg -> do_del();

			if($res){
				$this -> success('删除成功');
			}else{
				$this -> error('删除失败');
			}
		}

		public function find()
		{
			$msg = D('messages');

			$data = $msg -> do_find();

			$this -> assign($data);

			$this -> display('Messages:index');
		}
	}