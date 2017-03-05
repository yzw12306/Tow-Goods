<?php 
	namespace Admin\Model;
	use Think\Model;

	/**
	* 
	*/
	class OrdersModel extends Model
	{
		
		public function do_index()
		{
			// 计算数据总条数
			$totalRow = $this -> count();

			// 在页面显示的条数
			$num = 15;

			// 通过框架的Page类计算出总页数
			$page = new \Think\Page($totalRow , $num);

			$list = $this -> order('id desc') -> limit( $page -> firstRow . ',' . $page -> listRows) -> select();

			$status = [0 => '失效' , 1 => '未完成' , 2 => '已完成'];

			// 遍历数据，对数据做处理并且覆盖原数据
			foreach ($list as $key => &$val) {

				$sid = $val['saleid'];

				// 实例化users
				$users = D('users');

				//通过sid，查找出卖家信息
				$sinfo = $users -> find($sid);

				// 把查找到的卖家用户账号覆盖orders表的saleid
				$val['saleid'] = $sinfo['username'];

				$bid = $val['buyid'];

				// 查找买家账号信息
				$binfo = $users -> find($bid);

				// 把查找到的买家用户账号覆盖orders表的buyid
				$val['buyid'] = $binfo['username'];

				//自动把订单状态该为
				$finsh = $val['addtime'] + 30;

				// 判断订单是否超过有效完成时间，如果超过自动完成
				if($finsh <= time()){

					//修改订单状态
					$data['status'] = 2;

					// 所要修改订单的条件
					$where['id'] = $val['id'];

					$where['status'] = 1;

					$this -> where($where) -> save($data);
				}

				// 把时间戳改为年月日格式
				$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

				if ($val['status'] == 0 || $val['status'] == 2 ) {

					$val['disabled'] = 'disabled';

				}

				// 把状态改为文字格式
				$val['status'] = $status[$val['status']];
				
			}

			return [

				'list' => $list,

				'show' => $page -> show(),

			];
		}

		public function do_status()
		{
			// 获取所要修改状态的id
			$id = I('get.id');

			$map['id'] = $id;

			// 把状态改成失效
			$map['status'] = 0;

			$res = $this -> save($map);

			return $res;

		}
	}