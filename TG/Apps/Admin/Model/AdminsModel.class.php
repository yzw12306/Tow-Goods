<?php 
namespace Admin\Model;
use Think\Model;

class AdminsModel extends Model
{

	// $_validate 属性定义验证规则。
	protected $_validate = [

		// [验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]]
		['adminname','','账号已经存在！',0,'unique',1],

		['adminname','/^\w+$/','账号格式设置不正确！'],

		['realname','require','真实姓名必填！'],

		['sex','require','性别必填！'],

		['pass','6-12','密码长度不符合规范！' , 1, 'length' , 3],

		['pass1', 'pass' , '密码设置不一致！' , 1  , 'confirm',3],


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

		// 每页显示条数
		$num = 5;

		// 实例化分页类
		$page = new \Think\Page($totalRow , $num);

		// 执行分页查询
		$list = $this->order('id')->limit( $page->firstRow . ',' . $page->listRows )->select();

		$sex = ['女','男'];		

		$permission = D('permission');

		$data = $permission->field('id, rolename')->select();

		$root = [];

		foreach($data as $key => $val){

			$root[$val['id']] = $val['rolename'];

		}
		
		// 处理成正确的显示数据
		foreach($list as $key => &$val){

			$val['sex'] = $sex[ $val['sex'] ];

			$val['rolename'] = $root[ $val['root'] ];	

			$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

			$val['logintime'] = date('Y-m-d H:i:s',$val['logintime']);

		}			

		return [

			// 管理员列表
			'list' => $list,

			// 分页按钮
			'show' => $page->show(),

		];

	}

	// 处理单个在线管理员的数据，用于在模态框里进行展示
	public function pro_find()
	{	

		//接收管理员ID
        $id = I('get.id') + 0;	

		$person = $this->find($id);

		$sex = ['女','男'];		

		$status = [1 => '启用', 2 => '失效'];

		$permission = D('permission');

		$data = $permission->field('id, rolename')->select();

		$root = [];

		foreach($data as $key => $val){

			$root[$val['id']] = $val['rolename'];

		}
		
		$person['sex'] = $sex[ $person['sex'] ];

		$person['rolename'] = $root[ $person['root'] ];	

		$person['statusname'] = $status[ $person['status'] ];

		$person['addtime'] = date('Y-m-d H:i:s',$person['addtime']);

		$person['logintime'] = date('Y-m-d H:i:s',$person['logintime']);					

		// 在线管理员
		return $person;

	}

	//对管理员账号是否存在的检测
	public function pro_check()
	{

		$adminname = I("post.adminname");

		$map["adminname"] = ["eq", $adminname]; 

		$data = $this->where($map)->select();

		if($data){

			return 1;

		}else
		{

			return 0;

		}


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

			return "验证码输入错误！";

		}

		if(!$data){

			return "管理员账号不存在！";

		}

		if(!password_verify($post['pass'], $data[0]['pass'])){

			return "密码错误！";

		}
		
		$_SESSION["admin"] = $data[0];

		return "登录成功！";

	}

	public function pro_add()
	{

	 	$post = I('post.');
	
		$post['addtime'] = time();

		$post['logintime'] = time();

		// 创建数据创建对象，会触发自动验证
    	$res = $this->create($post);

    	if($res){

    		$res = $this->add();

    		return '数据添加成功！';

    	}else{

    		// 如果验证失败，则显示错误提示
	    	return $this->getError();

    	}
	}

	// 数据编辑完成之后做处理，加入自动验证
	public function pro_edit()
	{		

		// 在model层接收用户提交的数据
		$post = I('post.');

		// exit;
    	// 从数据库提取该id的原始密码
		$data = $this->find($post['id']);

		//原始密码与表单里获取的密码进行比较
		if(!password_verify($post['pass'], $data['pass'])){

			return "原始密码输入错误！";

		}else if(!empty($post['newpass'])){

			//原始密码比对正确，将字段pass里的值替换成表单里的重置密码newpass的值
			$post['pass'] = $post['newpass'];
		
		}

		$rules = [

			//第四个参数的值：0 存在字段就验证（默认）;1 必须验证; 2 值不为空的时候验证
			['realname','require','真实姓名必填！', 1],

			['pass','require','原始密码必填！', 1],

			['pass','6,12','密码长度不符合规范！' , 1, 'length' , 3],

			['newpass','6,12','密码长度不符合规范！' , 2, 'length' , 3],

			['newpass1','6,12','密码长度不符合规范！' , 2, 'length' , 3],

			['newpass1', 'newpass' , '重置密码设置不一致！' , 2, 'confirm',3],

		];


    	// 添加动态验证规则$rules，创建数据创建对象，会触发自动验证
    	$res = $this->validate($rules)->create($post);

		dump($res);
		// exit;
    	if($res){

    		$res = $this->save();
    		// dump($res);
    		return '数据更新成功！';

    	}else{

    		// 如果验证失败，则显示错误提示
	    	return $this->getError();

    	}
	}

	// 数据编辑完成之后做处理，加入自动验证
	public function pro_role()
	{		

		// 在model层接收用户提交的数据
		$post = I('post.');

		$data = $this->find($post['id']);
		
		$rules = [

			//第四个参数的值：0 存在字段就验证（默认）;1 必须验证; 2 值不为空的时候验证
			['root','require','角色权限必填！', 1],

			['root','number','角色权限值为数字！', 1],

		];

		$auto = [

			null
			
		];

    	// 添加动态验证规则$rules和动态完成$auto，防止静态的验证和完成干扰数据库操作，
    	// 创建数据创建对象，会触发自动验证
    	$res = $this->validate($rules)->auto($auto)->create($post);

    	if($res){

    		$res = $this->save();
    		// dump($res);
    		return '数据更新成功！';

    	}else{

    		// 如果验证失败，则显示错误提示
	    	return $this->getError();

    	}
	}
}