<?php 
namespace Admin\Controller;

class NoticesController extends EmptyController
{
	public function index()
	{
		$nt = D('Notices');

		$data = $nt->pro_index();

		$this->assign($data);

		$this->display();
	}

	public function add()
	{

		$this->display();
	}

	public function doadd()
	{
		$nt = D('Notices');

		$res = $nt->doadd();

		if($res == '添加成功'){

			$this->success($res);

		}else{

			$this->error($res);

		}
	}

	public function del()
	{
		$nt = D('Notices');
		//执行删除
		$res = $nt->dodel();
		//判断删除结果
		if($res){

			$this->success('删除成功',0);

		}else{

			$this->error('删除失败',0);

		}

	}

	public function edit()
	{
		$nt = D('Notices');

		$data = $nt->edit();

		$data['title'] = '修改公告';

		$data['id'] = I('get.id');

		$this->assign($data);

		$this->display();
	}

	public function doedit()
	{

		$nt = D('Notices');

		$res = $nt->doedit();

		if($res == '修改成功'){

			$this->success('修改成功',0);

		}else{

			$this->error($res,0);

		}
	}
}