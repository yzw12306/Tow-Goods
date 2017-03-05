<?php 
namespace Home\Model;
use Think\Model;

class OrdersModel extends Model
{

	public function add_order()
	{

		$post = I('post.');

		
		$address = D('useraddress');

		$addlist = $address->find($post['addr']);

		$post['buyid'] = $_SESSION['users']['id'];

		$post['linkman'] = $addlist['linkman'];

		$post['address'] = $addlist['address'];

		$post['phone'] = $addlist['phone'];

		$post['code'] = $addlist['code'];

		$post['addtime'] = time();

		if($this->create($post)){

			$res = $this->add();

			if($res){

				$product = D('products');

				if($product->where('id='.$post['productid'])->save(['status'=>2])){
					return 1;
				}

			}else{

				return '下单失败';

			}
		}else{

			return $this->getError();

		}

	}

}