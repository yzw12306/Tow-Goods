<?php 
namespace Home\Controller;

class EvaluateController extends CommonController
{

	public function index()
	{	
		$id = I('get.id');

		$orderid = I('get.orderid');

		$product = D('products');

		$list = $product -> find($id);

		$user = D('users');

		$userlist = $user -> find($list['userid']);

		$username = $userlist['username'];
		
		$this->assign('list',$list);

		$this->assign('username',$username);

		$this->assign('orderid',$orderid);

		$this->display();

	}


	public function add_eva()
	{

		$eva = D('evaluate');

		$data = I('post.');

		$data['addtime'] = time();

		if($eva->create($data)){

			$res = $eva->add();

			if($res){

				$user = D('users');

				//根据评分更改用户相应的积分
				$secord = $data['score'] - 3 ;


				$user->execute('update tg_users set secord = secord+'.$secord.' where id='.$data['userid']);

				$this->success('评价成功',U('Home/Person/myorders'),1);

			}else{

				$this->error('评价失败',U('Home/Person/myorders'),1);

			}

		}else{

			$this->error($eva->getError());

		}
	}

}