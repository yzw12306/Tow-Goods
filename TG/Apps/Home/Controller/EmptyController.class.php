<?php
namespace Home\Controller;

class EmptyController extends CommonController 
{	

    public function _empty($var)
	{

		dump($var."方法不存在！");

    }
}