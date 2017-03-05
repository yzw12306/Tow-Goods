<?php 
	namespace Admin\Model;
	use Think\Model;

	/**
	* 
	*/
	class MessagesModel extends Model
	{
		
		public function do_index()
		{

			$totalRow = $this -> count();

			$num = 15;

			$page = new \Think\Page($totalRow,$num);

			$list = $this -> where($where) -> order('id desc') -> limit( $page -> firstRow . ',' . $page -> listRows) -> select();

			$user = D('users');

			foreach ($list as $key => &$val) {

				$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

				$tuid = $val['touser'];

				$touser = $user -> find($tuid);

				$val['touser'] = $touser['username'];

				$fuid = $val['fromuser'];

				$fromuser = $user -> find($fuid);

				$val['fromuser'] = $fromuser['username'];

				$val['picname'] = $fromuser['picture'];
			}

			return [

				'list' => $list,

				'show' => $page -> show()

			];
		}

		public function do_del()
		{
			$id = I('get.id') + 0;

			$res = $this -> delete($id);

			return $res;
		}

		public function do_find()
		{
			$totalRow = $this -> count();

			$num = 15;

			$page = new \Think\Page($totalRow,$num);

			$id = I('get.id') + 0;

			$where['productid'] = $id;

			$list = $this -> where($where) -> order('id desc') -> limit( $page -> firstRow . ',' . $page -> listRows) -> select();

			$user = D('users');

			foreach ($list as $key => &$val) {

				$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

				$tuid = $val['touser'];

				$touser = $user -> find($tuid);

				$val['touser'] = $touser['username'];

				$fuid = $val['fromuser'];

				$fromuser = $user -> find($fuid);

				$val['fromuser'] = $fromuser['username'];

				$val['picname'] = $fromuser['picture'];
			}

			return [

				'list' => $list,

				'show' => $page -> show()

			];
		}
	}