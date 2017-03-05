<?php 
namespace Admin\Model;
use Think\Model;

class ProductsModel extends Model
{
	public function pro_index()
	{

		$totalRow = $this->count();

		$num = 10;

		$page = new \Think\Page($totalRow , $num);

		$data = I('get.');

		$this->save($data);

		$list = $this->order('id')->limit($page->firstRow . ',' . $page->listRows)->select();

		$type = M('type');

		//全部类别信息
		$typelist = $type->select();

		$users = M('users');

		//全部用户信息		
		$userslist = $users->select();

		//需要处理的字段
		$temp = [];

		$temo_u = [];

		$status = [1=>'启用',2=>'启用',3=>'失效'];

		$deliver = [1=>'快递',2=>'当面交货'];

		$fineness = ['非全新','全新'];

		$trade = [1=>'可以讲价',2=>'不讲价',3=>'拍卖'];

		//查询商品分类
		foreach($typelist as $key=>$val){

			//将类别id与name的对应放到一个临时数组的键值对中
			$temp[$val['id']] = $val['name'];

		}
		//查询商品分类
		foreach($userslist as $key=>$val){

			//将类别id与name的对应放到一个临时数组的键值对中
			$temp_u[$val['id']] = $val['username'];

		}
		//替换字段值
		foreach($list as $key=>&$val){
			//将时间戳替换为日期
			$val['addtime'] = date('Y-m-d',$val['addtime']);
			//类别ID替换为对应的类别名
			$val['typeid'] = $temp[$val['typeid']];

			$val['userid'] = $temp_u[$val['userid']];

			$val['status'] = $status[$val['status']];

			$val['deliver'] = $deliver[$val['deliver']];

			$val['fineness'] = $fineness[$val['fineness']];

			$val['trade'] = $trade[$val['trade']];
		}
		//返回商品数据和分页按钮
		return [

		'list' => $list,

		'show' => $page->show()
		];
	}

	public function doedit($id)
	{
		$list = $this->find($id);

		$map['id'] = ['eq',$id];

		if($list['status'] == '1'){

			$res = $this->where($map)->save(['status'=>'2']);

		}else{

			$res = $this->where($map)->save(['status'=>'1']);

		}

		return $res;
	}
}