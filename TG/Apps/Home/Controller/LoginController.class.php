<?php 
namespace Home\Controller;

class LoginController extends EmptyController
{
	public function login()
	{
		$this->display();
	}

	public function code()
	{
		$verify = new \Think\Verify();

		$verify->useCurve = false;

		$verify->length = 4;
		
		$verify->entry();

		$this->display();
	}

	public function do_login()
	{
		$users = D('users');

		$res = $users->pro_login();

		if(is_array($res)){

			$_SESSION['users'] = $res;

			$this->success('登录成功',U('Home/Index/index'),1);

		}else{

			$this->error($res,U('Home/Login/login'),1);

		}
	}

	public function ajax_login()
	{	
		if(!empty(I('post.username'))){
		$users = D('users');

		$res = $users->ajax();

			if(!$res){
				echo 1;
			}
		}
	}

	//退出登录
	public function logout()
	{
		$_SESSION['users'] = null;

		header('location:'.U('Home/Login/login'));
	}
}