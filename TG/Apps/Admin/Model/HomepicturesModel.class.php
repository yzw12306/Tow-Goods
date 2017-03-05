<?php 
	namespace Admin\Model;
	use Think\Model;

	/**
	* 
	*/
	class HomepicturesModel extends Model
	{	
		protected $_validate = [

			['title','/\S+/','怎么地也应该给我写几个字吧！'],


		];

		public function pro_index()
		{

			$totalRow = $this -> count();

			// 在页面显示的条数
			$num = 10;

			// 通过框架的Page类计算出总页数
			$page = new \Think\Page($totalRow , $num);

			//通过GET传值获取状态进行修改
			$sta = $_GET;

			$this -> save($sta);

			// 获取用户表信息
			$list = $this -> order('addtime desc') -> limit( $page -> firstRow . ',' . $page -> listRows) -> select();

			// 数据处理

			foreach ($list as $key => &$val) {

				$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

			}

			// 调用该方法时返回数据组
			return [

				'list' => $list,

				'show' => $page -> show(),

			];
			
		}
		
		public function doadd()
		{
			
			$msg = I('post.');

			if(!$this -> create($msg)){
				
				// 返回错误信息
				return $this -> getError();
			}

			if($msg['piclink']){

				$piclink = preg_replace('/^(http:\/\/|https:\/\/)+/', '', $msg['piclink']);
			
				$msg['piclink'] = 'http://'.strtolower($piclink);
				
			}
			
			// echo $piclink;
			return $msg;
		}

		public function doedit()
		{
			$data = I('post.');
			
			$list = $this -> find($data['id']);

			// 运用自动验证方法验证所上传的信息是否合法
			$res = $this -> create($data);

			if(!$res){

				// 返回错误信息
				return $this -> getError();

			}
			
		}


		public function del()
		{
			$id = I('get.id')+0;

			$data = $this -> find($id);

			// $id = 0;
			if($id){
				
				$res = $this -> delete($id);
				
				if($res){
					unlink( realpath('Public/Uploads/'.$data['picture']) );
				}
				
				return $res;
			}
		}
	}