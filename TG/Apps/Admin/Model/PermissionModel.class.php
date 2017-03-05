<?php 
namespace Admin\Model;
use Think\Model;

class PermissionModel extends Model
{

	// $_validate 属性定义验证规则。
	protected $_validate = [

		// [验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]]
		['rolename','require','角色名必填！'],

		['roledescription','0,200','简介长度不符合规范！' , 1, 'length' , 3],

	];

	// 自动完成
	protected $_auto = [

		// [完成字段1,完成规则,[完成条件,附加规则]],
		['pass','myHash',3,'function'],

	];


	// 处理管理员展示的数据
	public function pro_index()
	{

		// 得到总行数
		$totalRow = $this->count();

		// dump($totalRow);

		// 每页显示条数
		$num = 2;

		// 实例化分页类
		$page = new \Think\Page($totalRow , $num);

		// 执行分页查询
		$list = $this->order('id')->limit( $page->firstRow . ',' . $page->listRows )->select();

		// dump($list);

		return [

			// 用户列表
			'list' => $list,

			// 分页按钮
			'show' => $page->show(),

		];

	}

	public function pro_login()
	{

		$post = I("post.");

		$rules = [

			['adminname','require','账号必填！'],

			['pass','6-12','密码长度不符合规范！' , 1, 'length' , 3],

		];

		$map["adminname"] = ["eq", $post["adminname"]]; 

		$data = $this->where($map)->select();

		$verify = new \Think\Verify();

		if(!$verify->check($post["code"])){

			return $this->getError("验证码输入错误！");

		}


		if(!$data[0]['adminname']){

			return $this->getError("管理员账号不存在！");

		}
		if(!password_verify($post['pass'], $data[0]['pass'])){

			return $this->getError("密码错误！");

		}
		
		$_SESSION["admin"] = $data[0];

		return "登录成功！";

	}

	public function pro_add()
	{

	 	$post = I('post.');
		
		$moduleval = 0;

		foreach($post['moduleval'] as $key=>$val){

			$moduleval += $val;

		}
		
		$post['moduleval'] = $moduleval;

		$res = $this->create($post);

    	if($res){

    		$res = $this->add();

    		return '数据添加成功！';

    	}else{

    		// 如果验证失败，则显示错误提示
	    	return $this->getError();

    	}
	}

	// 权限表permission的字段moduleval(模块值)对应的模块表modules的字段moduleval(模块值)进行遍历位与，并设置一个标识，处理完后再渲染到编辑页面中
	public function pro_editBefore($id)
	{		

		$modules = D('modules');

		$res = $modules->select();
		
		$data = $this->find($id);
		
		foreach ($res as $key => &$value) {

			//权限表permission的字段moduleval(模块值)遍历与模块表modules的字段moduleval(模块值)进行遍历位与，并设置一个标识判断是否位与成功该值。
			$temp = ($data['moduleval'] + 0) & ($value['moduleval'] + 0);
			
			//进行模块值比对，判断是否拥有该权限
			if($temp === ($value['moduleval'] + 0)){

				$value['sign'] = true;

			}else
			{

				$value['sign'] = false;

			}
		}	
		// dump($res);
		// exit;
		return $res;
	}

	public function pro_editAfter($id)
	{		

		$post = I('post.');
		
		$moduleval = 0;

		foreach($post['moduleval'] as $key=>$val){

			$moduleval += $val;

		}
		
		$post['moduleval'] = $moduleval;

		$res = $this->create($post);

    	if($res){

    		$res = $this->save();

    		return '数据更新成功！';

    	}else{

    		// 如果验证失败，则显示错误提示
	    	return $this->getError("数据更新失败！");

    	}

	}
	
}