<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller 
{
	public function login()
    {

        $this->display();

    }

    public function dologin()
    {

        $admins = D("admins");

        $msg = $admins->pro_login();

        $this->success($msg, "../index/index");
    } 

    public function logout()
    {

    	//注销SESSION
        $_SESSION["admin"] = null;

        $this->redirect("Admin/Login/login", 0);

    }

    public function check()
    {

        $admins = D("admins");

        $msg = $admins->pro_check();

        $this->ajaxReturn($msg);

    }

    public function code()
    {

        $verify = new \Think\Verify();

        $verify->fontSize = 30;

        $verify->length = 4;

        $verify->useNoise = false;

        $verify->fontttf = '5.ttf';

        $verify->useImgBg = true;

        $verify->entry();

        $this->display();

    }
    
}