<?php 
	namespace Admin\Model;
	use Think\Model;

	/**
	* 
	*/
	class UsersModel extends Model
	{
		protected $_validate = [


			// [验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]]
			
			
			['email','email','邮箱格式不正确'],

			['realname','/^[\x{4e00}-\x{9fa5}]+(·[\x{4e00}-\x{9fa5}]+)*$/u','请输入中文名字',1,'regex',3],

			['phone','/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/','请输入正确的手机号',1,'regex',3],

		];
		
		public function pro_index()
		{
			// 计算数据总条数
			$totalRow = $this -> count();

			// 在页面显示的条数
			$num = 15;

			// 通过框架的Page类计算出总页数
			$page = new \Think\Page($totalRow , $num);

			// 获取用户表信息
			$list = $this -> order('id desc') -> limit( $page -> firstRow . ',' . $page -> listRows) -> select();

			// 数据处理
			$sex = ['女' , '男' , '妖'];

			$status = ['1' => '启用' , '2' => '失效'];

			foreach ($list as $key => &$val) {

				$val['sex'] = $sex[ $val['sex'] ];

				$val['status'] = $status[ $val['status'] ];

			}

			$sta = $_GET;

			$this -> save($sta);

			// 调用该方法时返回数据组
			return [

				'list' => $list,

				'show' => $page -> show(),

			];
		}


		public function pro_edit()
		{

			// 获取表单提交的内容
			$data = $_POST;	

			// 创建一个新数组，存放提交的年、月
			$date = [];

			$date[] = $data['year'];

			if(strlen($data['month'])<2){

				$date[] = '0'.$data['month'];

			}else{

				$date[] = $data['month'];

			}

			// 把出生年月拼接成字符串
			$date = implode('-', $date);

			$data['birth'] = $date;
			// dump($data);
			
			$res = $this -> create($data);
			// dump($res);
			
			if($res){

	    		$res = $this->save();

	    		// dump($res);

	    		return '修改成功';

	    	}else{

	    		// 如果验证失败，则显示错误提示
		    	return $this->getError();

	    	}

		}
	}
