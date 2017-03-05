<?php 


	// 配合自动完成的加密函数
	function myHash($val){
		// dump($val);
		$hash = password_hash($val , PASSWORD_DEFAULT);
		// dump($hash);
		return $hash;
	}


