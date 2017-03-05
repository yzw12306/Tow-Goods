<?php 
	namespace Admin\Model;
	use Think\Model;

	class TypeModel extends Model
	{
		protected $_validate = [

			['name','/([a-zA-Z0-9]|[\x{4e00}-\x{9fa5}])+/u','请正确输入一个类别名称',1,'regex',3]

		];

		public function pro_index()
		{
			$totalRow = $this -> count();
			// dump($totalRow);

			$num = 15;

			$page = new \Think\Page($totalRow,$num);
			// dump($page);

			$list = $this -> order('id') -> limit( $page -> firstRow . ',' . $page -> listRows ) -> select();

			return [

				'list' => $list,

				'show' => $page -> show()
			];


		}

		public function doadd()
		{
			// 获取表单提交的数据
			$data = $_POST;

			// 通过 create 方法自动调用自动验证方法
			if($this -> create($data)){

				// 通过 add() 方法组织 sql 语句添加数据到数据库
				$res = $this -> add($data);

				// 通过返回值判断是否添加成功
				if($res){

					return "添加成功";

				}else{

					return "添加失败";

				}
			}else{

				// 返回自动验证中的错误信息
				return $this -> getError();

			}
		}

		public function del()
		{
			$id = $_GET['id'];

			$map = [];

			// 查找该 id 是否存在子类
			$map['path'] = ['like' , '%'.$id.'%'];

			$res = $this -> where($map) -> select();

			if(!empty($res)){

				return "有子目录，不可以删除！";

			}else{

				$res = $this -> where('id='.$id) -> delete();

				if($res){
					return '删除成功';
				}else{
					return '删除失败';
				}
			}

		}

		public function doedit()
		{
			$data = I('post.');

			if($this -> create($data)){

				// 通过 add() 方法组织 sql 语句添加数据到数据库
				$res = $this -> save($data);
				
				// 通过返回值判断是否添加成功
				if($res){

					return "保存成功";

				}else{

					return "保存失败";

				}
			}else{

				// 返回自动验证中的错误信息
				return $this -> getError();

			}
		}
	}