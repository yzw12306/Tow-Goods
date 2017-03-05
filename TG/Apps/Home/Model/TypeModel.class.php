<?php 
namespace Home\Model;
use Think\Model;

class TypeModel extends Model
{

	public function ajax()
	{

		$map['pid']	= ['eq',I('post.pid')];

		$data = $this->where($map)->select();

		return $data;
	}

	
}