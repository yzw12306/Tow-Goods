<?php
namespace Home\Controller;

class ProductsController extends CommonController 
{

    public function index()
    {  	

    	//实例化商品列表
    	$products = D("products");

    	//调用商品列表预处理函数
        $data = $products -> pro_index();

    	$this -> assign($data);

    	$this -> display();
    	
    }

}