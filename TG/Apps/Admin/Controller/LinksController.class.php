<?php 
namespace Admin\Controller;

class LinksController extends EmptyController
{
	public function index()
	{
		$lk = D('links');

		$data = $lk->pro_index();

		$this->assign($data);

		$this->display();

	}

	public function add()
	{

		$this->display();

	}

	public function doadd()
	{
		$lk = D('Links');

		$res = $lk->doadd();

		if($res == '添加成功'){

			$this->success($res);

		}else{

			$this->error($res);

		}
	}

	public function del()
	{
		$lk = D('Links');
		//执行删除
		$res = $lk->dodel();
		//判断删除结果
		if($res){

			$this->success('删除成功',0);

		}else{

			$this->error('删除失败',0);

		}

	}

	public function edit()
	{
		$lk = D('Links');

		$data = $lk->edit();

		$data['title'] = '修改友情链接';

		$data['id'] = I('get.id');

		$this->assign($data);

		$this->display();
	}

	public function doedit()
	{

		$lk = D('Links');

		$res = $lk->doedit();

		if($res == '修改成功'){

			$this->success('修改成功',0);

		}else{

			$this->error($res,0);

		}
	}
}