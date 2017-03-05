<?php 
	namespace Home\Model;
	use Think\Model;

	/**
	* 
	*/
	class MessagesModel extends Model
	{
		protected $_validate = [
			['message','/\S+/',"请输入文字",1,'regex',3],
		];
		
		public function do_msg()
		{
			// 获取页面提交的内容
			$data = I('get.');

			// 添加时间
			$data['addtime'] = time();

			// 通过session获取所登录的用户ID
			$data['fromuser'] = $_SESSION['users']['id'];

			// 执行自动验证
			$res= $this -> create($data);

			if($res){
				$this -> add($data);
				return 0;
			}else{
				return $this -> getError();
			}
		}

		public function show_msg()
		{

			$map['productid'] = I('get.id');

			$data = $this -> where($map) -> select();

			$user = D('users');

			foreach ($data as $key => &$val) {

				$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

				$tuid = $val['touser'];

				$touser = $user -> find($tuid);

				$val['touser'] = $touser['username'];

				$fuid = $val['fromuser'];

				$fromuser = $user -> find($fuid);

				$val['fromuser'] = $fromuser['username'];

				$val['picname'] = $fromuser['picture'];
			}

			return $data;

		}


		public function do_reply()
		{
			$id = I('get.id');

			$floor = I('get.floor')+1;

			$data['floor'] = $floor; 

			$res = $this -> find($id);

			$data['touser'] = $res['fromuser'];

			$data['fromuser'] = $_SESSION['users']['id'];

			$data['addtime'] = time();

			$data['productid'] = I('get.productid');

			$message = I('get.message');

			$data['message'] = $message;

			if($this -> create($data)){

				$this -> add($data);

				return 0;

			}else{

				return $this -> getError();

			}
		}
	}