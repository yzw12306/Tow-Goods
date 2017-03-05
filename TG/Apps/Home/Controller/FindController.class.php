<?php 
namespace Home\Controller;

class FindController extends EmptyController
{
	// 展示找回密码页面
	public function index()
	{

		$this->display();

	}
	//生成验证码
	public function code()
	{

		$verify = new \Think\Verify();

		$verify->useCurve = false;

		$verify->length = 4;

		$verify->entry();

		$this->display();

	}


	//验证账号信息，展示重置页面
	public function reseting()
	{	

		$verify = new \Think\Verify();

		if(!$verify->check(I('post.vcode'))){

			$this->error('验证码错误',U('Home/Find/index'),1);

			exit;
		}
		if(I('post.email') == ''){

			$this->error('账号信息不能为空',U('Home/Find/index'),1);

			exit;
		}

		$users = D('users');

		$res = $users->chec();

		if($res){

			// $this->assign('id',I('post.id'));

			// $this->display();

			$key = md5(I('post.id'));

			$result = sendMail($res[0]['email'],'二货网|找回密码','您好，'.$res['username'].':<br><br>听说你<strong>二货网</strong>的密码不记得了？!请点击下面的链接来重置您的密码<br><br>http://'.HOST_ADDR.U('Home/find/reset',['key'=>$key]).'<br><br><strong>此链接打死都不能给别人</strong><br><br>如果您的邮箱不支持链接点击，请将以上链接地址拷贝到浏览器地址栏进行激活');

			if($result == 'ok'){

					$this->success('验证通过',U('Home/find/waiting'),1);

				}else{

					echo $result;

				}
		}else{

			$this->error('账号信息不匹配,请重试',U('Home/Find/index'),1);

		}

		
	}

	public function waiting(){

		$this->display();

	}

	public function reset(){

		$codekey = I('get.key');

		$id = 0;

		$user = D('users');

		$userlist = $user->select();

		foreach($userlist as $key=>$val){

			if(md5($val['id']) == $codekey){

				$id = $val['id'];

			}

		}

		$this->assign('id',$id);

		$this->display();
		
	}

	//重置密码
	public function do_reset()
	{
		$post = I('post.');

		$verify = new \Think\Verify();

		if(!$verify->check($post['vcode'])){

			$this->error('验证码错误');

			exit;
		}

		if($post['pass'] !== $post['passrepeat']){

			$this->error('两次密码不一致');

			exit;
		}

		$users = D('users');

		$res = $users->do_reset();

		if($res){

			$this->success('重置密码成功',U('Home/Login/login'),1);

		}else{

			$this->error('重置密码失败',U('Home/Find/index'),1);

		}
	}

	public function ajax_find()
	{
		$users = D('users');

		$res = $users->ajax();

		if($res){

			$this->ajaxReturn($res[0]['id']);

		}
	}

}