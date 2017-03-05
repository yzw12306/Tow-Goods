<?php 
	namespace Admin\Controller;

	/**
	* 用户控制类
	*/
	class UsersController extends EmptyController
	{

		public function index()
		{

			$users = D('Users');

			$data = $users -> pro_index();

			$this -> assign($data);

			$this -> display();

		}

		public function edit()
		{
			// 接收用户ID
			$id = I('get.id') + 0;

			//实例化Users对象
			$user = D('users');

			// 通过id查找数据
			$info = $user -> find($id);

			// 把出生年月提取出来
			$birth = $info['birth'];

			// 把出生年月去掉拼接符号，变成年和月的一个数组
			$birth = explode('-',$birth);

			$data['info'] = $info;

			$data['birth'] = $birth;

			$data['title'] = '修改用户信息';

			$this -> assign($data);

			$this -> display();
		}

		public function doedit()
		{
			$user = D('users');

			$msg = $user -> pro_edit();

			$this -> success($msg,U('Admin/Users/index'),2);

		}

		public function del()
		{
			$user = D('users');

			// 接收所要删除的id
			$id = I('get.id') + 0;

			$res = $user -> delete($id);

			if ($res) {
				$this -> success('删除成功');
			}
		}
	}
