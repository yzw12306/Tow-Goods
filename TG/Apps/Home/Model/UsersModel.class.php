<?php 
namespace Home\Model;
use Think\Model;

class UsersModel extends Model
{
	protected $_validate = [
		// [验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]]
		['username','require','用户名不能为空'],

		['username','','该用户名已存在',1,'unique',3],

		['email','','该邮箱已被使用',1,'unique',3],

		['username','/^[a-zA-Z_][a-zA-Z0-9_]{2,11}$/','用户名为3-12个字符数字或者英文',1,'regex',3],

		['pass','/^[a-zA-Z0-9_]{6,12}$/','密码为6-12个字符',1,'regex',1],

		['passrepeat','pass','两次输入的密码不一致',1,'confirm',3],

		['email','email','请输入正确的邮箱格式'],

		['phone','/^[1][3578][0-9]{9}$/','请输入正确的联系电话'],

		['realname','/^[\x{4e00}-\x{9fa5}]+(·[\x{4e00}-\x{9fa5}]+)*$/u','请输入中文名字'],
	];

	protected $_auto = [
		//自动完成，pass字段的哈希加密
		['pass','myHash',3,'function'],
	];

	//验证注册信息
	public function register()
	{

		$post = I('post.');

		$res = $this->add();

		if($res){
			$list = $this->where('id='.$res)->select();
			return $list[0];

		}else{

			return '注册失败!';

		}
	}

	//验证登录信息
	public function pro_login()
	{
		$post = I('post.');

		$verify = new \Think\Verify();

		if(!$verify->check($post['vcode'])){

			return '验证码错误!';

		}

		$map['username'] = ['eq',$post['username']];

		$data = $this->where($map)->select();


		if(!$data){

			return '用户名不存在!';

		}

		if($data[0]['isactive'] == 0){

			return '该用户未激活';

		}elseif(!password_verify($post['pass'],$data[0]['pass'])){

			return '账号或密码错误，请重试!';

		}else{

			$list= ['logintime'=>time()];
			
			$this->where($map)->save($list);

			return $data[0];

		}

	}

	//ajax 验证账号是否存在
	public function ajax()
	{

		$map['username'] = ['eq',I('post.username')];

		$res = $this->where($map)->select();

		return $res;
	}

	//找回密码->验证账号信息
	public function chec()
	{
		$data = I('post.');

		$map['username'] = ['eq',$data['username']];

		$map['email'] = ['eq',$data['email']];

		$res = $this->where($map)->select();

		return $res;

	}

	//执行重置密码
	public function do_reset()
	{
		$post = I('post.');

		$map['id'] = ['eq',$post['id']];

		$data['pass'] = password_hash($post['pass'],PASSWORD_DEFAULT);

		$res = $this->where($map)->save($data);

		return $res;
	}

	//执行修改密码
	public function per_reset()
	{
		$post = I('post.');

		$list = $this->where('id='.$post['id'])->select();

		if(!password_verify($post['oldpass'],$list[0]['pass'])){
			return '密码错误';
		}

		if($post['pass'] !== $post['passrepeat']){
			return '两次输入密码不一致';
		}

		$verify = new \Think\Verify();

		if(!$verify->check($post['vcode'])){
			return '验证码错误';
		}
		$data['pass'] = password_hash($post['pass'],PASSWORD_DEFAULT);

		$res = $this->where('id='.$post['id'])->save($data);

		if($res){
			return '修改成功';
		}else{
			return '修改失败';
		}
	}

	//修改个人信息
	public function edit()
	{
		$post = I('post.');

		$map['id'] = ['eq',$post['id']];

		$info = $this->upload();

		if($info){

			$post['picture'] = $info['headerpic']['savename'];
			unlink('./Public/Uploads/Head_pic/'.$post['oldpicname']);

		}

		$post['birth'] = strtotime($post['birth']);

		if($this->create($post)){

			$this->where($map)->save();

			$res = $this->where($map)->select();

			return $res[0];

		}else{

			return $this->getError();

		}
	}

	//上传用户头像
	public function upload()
	{

		$upload = new \Think\Upload();// 实例化上传类
		
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		
		$upload->rootPath = './Public/Uploads/Head_pic/'; // 设置附件上传根目录
		// 设置是否自动使用子目录保存上传文件
		$upload ->autoSub   =    false;
		
		$upload->savePath = ''; // 设置附件上传（子）目录
		// 上传文件
		$info = $upload->upload();
		
		return $info;

	}

	public function do_details($uid)
	{
		$id = $uid;

		$list = $this -> find($id);

		if(!$_SESSION['users']){
			$list['phone'] = substr($list['phone'],0,4)."****".substr($list['phone'],-3);
		}

		$list['addtime'] = date('Y-m-d H:i:s',$list['addtime']);

		$list['logintime'] = date('Y-m-d H:i:s',$list['logintime']);

		return $list;
			
	}

}