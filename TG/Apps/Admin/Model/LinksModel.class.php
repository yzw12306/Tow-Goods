<?php 
namespace Admin\Model;
use Think\Model;

class LinksModel extends Model
{
	protected $_validate = [

			['linkname','require','链接名称不能为空',3],

			['linksite','url','请输入正确的URL',3]

		];


	public function pro_index()
	{

		$totalRow = $this->count();

		$num = 5;

		$page = new \Think\Page($totalRow , $num);

		$list = $this->order('id')->limit($page->firstRow . ',' . $page->listRows)->select();

		foreach($list as &$val){

			$val['addtime'] = date('Y-m-d',$val['addtime']);

		}

		return [

		'list'=>$list,

		'show'=>$page->show()

		];

	}

	public function doadd()
	{

		$map = I('post.');

		$map['author'] = $_SESSION['admin']['adminname'];

		$map['addtime'] = time();
		
		//用自定义函数myltrim() 自动填充'http://'
		$map['linksite'] = myltrim($map['linksite']);

		if($this -> create($map)){

				// 通过 add() 方法组织 sql 语句添加数据到数据库
				$res = $this -> add($map);

				// 通过返回值判断是否添加成功
				if($res){

					return "添加成功";

				}else{

					return "添加失败";

				}
			}else{

				// 返回自动验证中的错误信息
				return $this -> getError();

			}
	}

	public function dodel()
	{

		$id = I('get.id');

		$res = $this->where('id='.$id)->delete();

		return $res;
	}

	public function edit()
	{
		
		$id = I('get.id');

		$list = $this->where('id='.$id)->select();

		return ['list'=>$list];
	}

	public function doedit()
	{

		$map = I('post.');
		
		if($this -> create($map)){

				// 通过 save() 方法组织 sql 语句更新数据到数据库
				$res = $this -> save($map);

				// 通过返回值判断是否添加成功

				if($res){

					return "添加成功";

				}else{

					return "添加失败";

				}

			}else{

				// 返回自动验证中的错误信息
				return $this -> getError();

			}
	}
}