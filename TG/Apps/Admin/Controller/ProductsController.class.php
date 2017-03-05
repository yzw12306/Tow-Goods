<?php 
namespace Admin\Controller;

	class ProductsController extends EmptyController
	{

		public function index()
		{
			$pd = D('Products');

			$data = $pd->pro_index();

			$this->assign($data);

			$this->display();
		}


	}