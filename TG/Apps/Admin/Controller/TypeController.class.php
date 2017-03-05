<?php 
	namespace Admin\Controller;

	/**
	* 
	*/
	class TypeController extends EmptyController
	{
		
		public function index()
		{
			$ty = D('type');
			
			$data = $ty -> pro_index();

			// dump($data);

			$this -> assign($data);

			$this -> display();
		}

		public function add()
		{
			// 初始化化参数
			$pid = 0;

			$path = '0,';

			$name = "根类别";

			
			//判断是否有通过GET传值过来，有就覆盖
			if(isset($_GET['pid']) && isset($_GET['path'])){
				$pid = $_GET['pid'];
				$path = $_GET['path'].$pid.",";
				$name = $_GET['name'];
			}

			// 创建一个新数组接收 pid path name
			$data = [];

			$data['pid'] = $pid;

			$data['path'] = $path;

			$data['name'] = $name;

			// dump($data);
			
			$this -> assign($data);

			$this -> display();
		}

		public function doadd()
		{
			// 实例化对象
			$ty = D('type');

			// 调用 doadd() 方法 
			$msg = $ty -> doadd();

			// 跳转页面
			$this -> success($msg,U('Admin/Type/index'),1);

		}

		public function del()
		{
			$ty = D('type');

			$msg = $ty -> del();

			$this -> success($msg,U('Admin/Type/index'),1);
		}

		public function edit()
		{
			$ty = D('type');

			$id = I('get.id');

			$pid = I('get.pid');

			$ls = $ty -> select();

			$pname = '根类别';

			foreach ($ls as $key => $val) {
				if($pid == $val['id']){
					$pname = $val['name'];
				}
			}

			$list = $ty -> find($id);

			$data = [];

			$data['list'] = $list;

			$data['pname'] = $pname;
			// dump($data);

			$this -> assign($data);

			$this -> display();
		}

		public function doedit()
		{
			$ty = D('type');
			$msg = $ty -> doedit();
			$this -> success($msg,U('Admin/Type/index'),1);
		}
	}