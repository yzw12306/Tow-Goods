<?php 
namespace Home\Model;
use Think\Model;

class UseraddressModel extends Model
{
	protected $_validate = [
		// [验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]]
		['userid','require','用户ID不能为空',3],

		['linkman','require','联系人不能为空',3],

		['phone','require','联系电话不能为空',3],

		['phone','/^[1][3578][0-9]{9}$/','请输入正确的联系电话',1,'regex',3],

		['address','require','联系地址不能为空',3],
	];

	public function pro_address()
	{

		$map['userid'] = ['eq',$_SESSION['users']['id']];

		$data = $this->where($map)->select();

		return $data;
	}

	public function del()
	{

		$map['id'] = ['eq',I('get.id')];

		$res = $this->where($map)->delete();

		return $res;

	}

	public function edit()
	{

		$post = I('post.');

		$map['id'] = ['eq',$post['id']];
		if($this->create($post)){

			$res = $this->where($map)->save($post);

		}else{

			$res = $this->getError();
			
		}

		return $res;

	}


}