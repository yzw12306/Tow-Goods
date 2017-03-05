<?php
namespace Admin\Controller;

class AdminsController extends EmptyController 
{

    public function index()
	{     

        //实例管理员表admins
        $admins = D("admins");

		$data = $admins -> pro_index();

		$data["title"] = "管理员列表";

		$this -> assign($data);

		$this -> display();

    }

    public function saveStatus()
    {

         // 接收管理员ID
        $id = I('get.id') + 0;

         // 接受角色ID
        $root = I('get.root') + 0;

        //实例管理员表admins
        $admins = D("admins");

        $has_permission = $this -> rolePermission($root, $id);
       
        if( $has_permission ){
            
            $status_save = $_GET;

            $admins -> save($status_save);

            $this->success("您修改该管理员的状态成功！", "");

        }else{

            $this->success("您没有权限修改该管理员的状态！", "");

        }   

    }

    //查看在线管理员的详细信息
    public function lookPerson()
    {  

        $admins = D('admins');

        $data = $admins->pro_find();      

        $this -> ajaxReturn($data);

    }

    //查看管理员的模块权限信息
    public function lookAdmin()
    {

        // 接收管理员ID
        $id = I('get.id') + 0;

        // 接受角色ID
        $root = I('get.root') + 0;

        // $admins = D('admins');

        // $data = $admins->find($id);
        $data = [];

        $permission = D('permission');

        $permission = $permission -> find($root);

        $permission_moduleval = $permission['moduleval'] + 0;

        $data['rolename'] = $permission['rolename'];

        $modules = D('modules');

        $modules = $modules -> select();

        $modulenames = [];

        foreach ($modules as $key => $value) {

            $modules_moduleval = $value['moduleval'] + 0;
            
            if ($permission_moduleval & $modules_moduleval) {
              
                $modulenames[] = $value['modulename'];

            }

        }

        $data['modulenames'] = $modulenames;

        $this -> ajaxReturn($data);

    }

    //要修改管理员的角色权限，在模态框里以单选按钮的形式显示角色权限信息
    public function role()
    {

        // 接收管理员ID
        $id = I('post.id') + 0;

        // 接受角色ID
        $root = I('post.root') + 0;

        //根据传来的管理员参数值，来判断是否具有该操作权限
        $has_permission = $this -> rolePermission($root, $id);
        
        //如果没有权限就终止运行
        if(!$has_permission){

            exit;

        }

        $permission = D('permission');

        $roles = $permission -> select();

        foreach ($roles as $key => &$val) {

            if($root == ($val['id'] + 0)){

                $val['sign'] = true;

            }else
            {

                $val['sign'] = false;

            }
        }

        $this -> ajaxReturn($roles);

    }

    //保存修改管理员的角色权限信息
    public function dorole()
    {

        // 接收管理员ID
        $id = I('post.id') + 0;

        // 接受管理员权限root的值
        $root = I('post.root') + 0;

        // 使用自动验证，必须走Model层
        $admins = D('admins');

        // 调用model层的数据处理方法
        $msg = $admins -> pro_role();      

        // 跳转回管理员列表页
        $this -> success($msg, U("/Admin/Admins/index"));

    }

    public function add()
    {

        // 1.实例化
        $permission = D('permission');

        $permission = $permission -> select();

        $data['permission'] = $permission;

        $this -> assign($data);

        $this -> display();

    }

    public function doadd()
    {  

        // 接受管理员权限root的值
        $root = I('post.root') + 0;  

        $has_permission = $this -> rolePermission($root);

        // 1.实例化
        $admins = D('admins');

        if($has_permission)
        {

            $msg = $admins -> pro_add();

        }else{

            $msg = "您没有权限添加管理员，或者不能再添加超级管理员！";

        }
        
        // 2.跳转
        $this -> success($msg, U("/Admin/Admins/index"));

    }
    
    // 加载编辑模板
    public function edit()
    {

        // 接收用户ID
        $id = I('get.id') + 0;

        // 实例化
        $admins = D('admins');

        // find : 只找一条信息
        // 查询用户信息
        $info = $admins -> find($id);

        // dump($info);
        $data['info'] = $info;

        $data['title'] = '管理员修改';

        $this -> assign($data);

        $this -> display();

    }

    public function doedit()
    {

        // 使用自动验证，必须走Model层
        $admins = D('admins');

        // 调用model层的数据处理方法
        $msg = $admins -> pro_edit();

        // 跳转回管理员列表页
        $this -> success($msg, U("/Admin/Admins/index"));

    }
    
    // // ajax提交管理员删除信息,来检测是否有权限删除
    // public function delCheck(){

    //     // 接收管理员ID
    //     $id = I('post.id') + 0;

    //     // 接受管理员权限root的值
    //     $root = I('post.root') + 0;

    //     $has_permission = $this -> rolePermission($root, $id);

    //     if($has_permission){

    //         $this -> ajaxReturn(1);

    //     }else{

    //         $this -> ajaxReturn(0);

    //     }
    	
    // }

    //模态框表单提交删除管理员信息
    public function del()
    {

        // 接收管理员ID
        $id = I('post.id') + 0;

        // 接受管理员权限root的值
        $root = I('post.root') + 0;

        $has_permission = $this -> rolePermission($root, $id);
          
        if($has_permission){

            // 实例化对象
            $admins = D('admins');

            // 执行删除，返回受影响行
            $res = $admins -> delete($id);

            if($res){

                // 默认返回上一个URL(来源地址)
                $this -> success( '删除成功!','');

            }else{

                $this -> error('删除失败!','');

            }

        }else{

            $this -> success( '您无权限删除该管理员!','');

        }       

    }

    // /**
    //  * [rolePermission 角色权限操作管理函数]
    //  * @param  [type] $id   [管理员ID]
    //  * @param  [type] $root [管理员的权限值，也是角色ID]
    //  * @return [type]       [能够操作角色权限的情况就返回1，否则返回0]
    //  */
    // private function rolePermission($root, $id = 0)
    // {

    //     //管理员不能操作自己的角色权限，还有只有超级管理员才能操作其他管理员的角色权限，
    //     //超级管理员不能被其他管理员操作
    //     if($id == $_SESSION['admin']['id'] || $_SESSION['admin']['root'] != 1 || $root == 1){

    //         return 0;

    //     }else{

    //         return 1;
    //     }

    // }

}