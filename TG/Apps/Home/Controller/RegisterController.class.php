<?php 
namespace Home\Controller;

class RegisterController extends EmptyController
{
	public function register()
	{
		$this->display();
	}

	public function code()
	{
		$verify = new \Think\Verify();

		$verify->useCurve = false;

		$verify->length = 4;

		$verify->fontSize = 100;
		
		$verify->entry();

		$this->display();

	}

	public function do_register()
	{
		$users = D('users');
		
		$post = I('post.');

		$post['addtime'] = time();

		if($users->create($post)){

			$res = $users->register();

			if( is_array( $res ) ){

				// $_SESSION['users'] = $res;
				// $key = md5($res['id']);
				$key = md5($res['id']);

				$result = sendMail($res['email'],'二货网|账号激活','您好，'.$res['username'].':<br><br>欢迎加入<strong>二货网</strong>!请点击下面的链接来激活您的账号<br><br>http://'.HOST_ADDR.U('Home/Register/activing',['key'=>$key]).'<br><br>如果您的邮箱不支持链接点击，请将以上链接地址拷贝到浏览器地址栏进行激活');

				if($result == 'ok'){

					$this->success('注册成功',U('Home/Register/active'),1);

				}else{

					echo $result;

				}

				

			}else{

				$this->error($res,U('Home/Register/register'),1);
				
			}

		}else{

			$this->error($users->getError(),U('Home/Register/register'),1);

		}
	}

	public function ajax_reg()
	{
		$users = D('users');

		$res = $users->ajax();

		if($res){
			echo 1;
		}
	}

	public function active(){

		// echo '注册成功，请进入您的邮箱进行账号激活!<br><a href="https://mail.qq.com/">QQ邮箱</a><br><a href="http://mail.163.com/">163邮箱</a><br><a href="http://mail.sina.com.cn/">新浪邮箱</a>';
		// echo sendMail('','','');

		$this->display();
		
	}

	public function activing(){

		$codekey = $_GET['key'];

		$user = D('users');

		$info = 'null';

		$userlist = $user->where('isActive=0')->select();

		foreach($userlist as $key=>$val){

			if(md5($val['id']) == $codekey){

				$data['id'] = $val['id'];

				$data['isActive'] = 1;

				$res = $user->save($data);

				if($res){
					
					$info = 'ok';

				}

						

			}

			$this->assign('info',$info);

					$this->display();

		}

	}

}