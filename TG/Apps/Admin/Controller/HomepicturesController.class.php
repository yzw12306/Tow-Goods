<?php 
	namespace Admin\Controller;

	class HomepicturesController extends EmptyController
	{

		public function index()
		{
			$hp = D('homepictures');

			$data = $hp -> pro_index();

			// dump($data);

			$this -> assign($data);

			$this -> display();
		}


		public function Uploads()
		{
			// 实例化上传类 
			$upload = new \Think\Upload();

			// 设置附件上传大小    
			$upload->maxSize    =     3145728 ;

			// 设置附件上传类型    
			$upload->exts       =     array('jpg', 'gif', 'png', 'jpeg');

			//设置上传文件名
			$upload->saveName   =     date('Ymd',time()).time().mt_rand(0,10000);

			// 设置附件上传根目录  
			$upload->rootPath   =     './Public/Uploads/';  

			// 设置是否自动使用子目录保存上传文件
			$upload ->autoSub   =    false;

			// 上传文件  
			$info   =   $upload->upload(); 

			// 判断是否上传成功
			if(!$info) {

				// 上传错误提示错误信息        
				return $this->error($upload->getError());  

			}else{
				return $info;
			}
		}


		public function add()
		{

			$this -> assign('title','添加广告');

			$this -> display();
		}


		public function doadd()
		{

			$hp = D('homepictures');

			$data = [];

			$data = $hp -> doadd();

			// 判断输入的信息是否合法
			if(!$data){

				header('Refresh: 1; url='.U('Admin/Homepictures/add'));

				exit('怎么地也应该给我写几个字吧！');

			}

			$info = $this -> uploads();

			if($info){

				// 上传成功 获取上传文件信息         
				$data['picture'] = $info['pic']['savename'];  

				$time = time();

				// 把时间戳添加到数组中，以便写入添加时间
				$data['addtime'] = $time;

				$res = $hp -> add($data);

				if($res){

					$this -> success('添加成功');

				}else{

					$this -> error('添加失败');

				} 
			}  
		}


		public function edit()
		{
			$hp = D('Homepictures');

			$id = I('get.id');

			$data = $hp -> find($id);

			$this -> assign($data);

			$this -> display();
		}


		public function doedit()
		{
			$hp = D('Homepictures');
			
			$msg = $hp -> doedit();

			if(!$msg){

				$data = [];

				$data = I('post.');

				if($data['piclink']){

					// 正则判断是否有输入 http:// 或者https:// 有则替换成空字符串
					$piclink = preg_replace('/^(http:\/\/|https:\/\/)+/', '', $data['piclink']);
					
					// 把地址转换小写并且加上 http://
					$data['piclink'] = 'http://'.strtolower($piclink);
					
				}

				$list = $hp -> find($data['id']);

				//判断是否有上传图片
				if( $_FILES['pic']['error'] != 0 ){

					// 如果没有上传，则保存修改文字信息
					$hp -> save($data);

					$this -> success('修改成功',U('Admin/Homepictures/index'),2);

				}else{
					
					$info = $this -> uploads();

					// 如果有上传并且上传成功则删除原来的图片
					unlink( realpath('Public/Uploads/'.$list['picture']) );

					// 重新准备图片名称，覆盖前面图片名称的数据
					$data['picture'] = $info['pic']['savename'];  

					$hp -> save($data);

					$this -> success('修改成功',U('Admin/Homepictures/index'),2);

				}
			}else{

				$this -> error($msg,U('Admin/Homepictures/index'),2);

			}

		}


		public function del()
		{
			$hp = D('homepictures');

			$msg = $hp -> del();

			if($msg){

				$this -> success('删除成功');

			}else{

				$this -> error('删除失败');
				
			}

		}
	}