<?php
namespace Home\Widget;
use Think\Controller;

class CateWidget extends Controller 
{
	public function menu()
	{

		if(!isset($_SESSION['users'])){

			$data = "<li>{$_SESSION['users']['username']}</li>";

		}else{

			$data = '<li><a href="#">注册</a></li><li><a href="#">登录</a></li>';

		}

		$this->assign("data", $data);

		$this->display('Cate:menu');

	}    
    
    public function foot()
    {

    	$this->display('Cate:foot');
    	
    }

}