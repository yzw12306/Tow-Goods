<?php 
	namespace Home\Controller;

	/**
	* 
	*/
	class CollectionController extends CommonController
	{
		
		public function status()
		{
			$collection = D('collection');

			$map['productid'] = I('get.id');

			// $map['userid'] = $_SESSION['users']['id'];
			$map['userid'] = 13;

			$res = $collection -> where($map) -> count();

			if($res){

				$collection -> where($map) -> delete();
				$res = '';

			}else{

				$map['addtime'] = time();

				$collection -> add($map);

				$res = 1;
			}

			$this->ajaxReturn($res);

		}
	}