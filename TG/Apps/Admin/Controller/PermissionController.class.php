<?php
namespace Admin\Controller;

class PermissionController extends EmptyController 
{

    public function index()
	{      

		$permission = D("permission");

		$data = $permission->pro_index();

		$data["title"] = "权限列表";

		$this->assign($data);

		$this->display();
    }

    public function add()
    {
        $modules = D('modules');

        $module = $modules->select();

        $data['modules'] = $module;

        $data['title'] = '角色添加';

        $this->assign($data);

        $this->display();

    }

    public function doadd()
    {
       
        // 接受角色权限permission表id的值
        $root = I('post.id') + 0;  
        // 1.实例化
        $permission = D('permission');

        $has_permission = $this -> rolePermission($root);

        if($has_permission)
        {

            $msg = $permission->pro_add();

        }else{

            $msg = "您没有权限添加角色权限，或者不能再添加超管角色权限！";

        }
      
        // 2.跳转
        $this->success($msg, U("Admin/Permission/index"));
    }
    
    // 加载编辑模板
    public function edit()
    {

        // 接收权限表permission的id值
        $id = I('post.id') + 0;

        // 实例化
        $permission = D('permission');

        // find : 只找一条信息
        $info = $permission->find($id);
        
        $modules = $permission->pro_editBefore($id);

        // dump($info);
        $data['info'] = $info;

        $data['modules'] = $modules;

        $data['title'] = '权限修改';

        $this->assign($data);

        $this->display();

    }

    public function doedit()
    {

        // 接受权限表permission的id值,也是管理员表admins的root的值
        $root = I('post.id') + 0;

        $has_permission = $this -> rolePermission($root);
          
        if($has_permission){

            // 1.使用自动验证，必须走Model层
            $permission = D('permission');

            // 2.调用model层的数据处理方法
            $msg = $permission->pro_editAfter();

            // 3.跳转
            $this->success($msg, U("Admin/Permission/index"));

        }else{

            $this -> success( '您无权限删除该角色!','');

        }

    }

    // 角色权限的删除
    public function del()
    {

        // 接受权限表permission的id值,也是管理员表admins的root的值
        $root = I('post.id') + 0;

        $has_permission = $this -> rolePermission($root);
          
        if($has_permission){

        	// 实例化对象
        	$permission = D('permission');

        	// 执行删除，返回受影响行
        	$res = $permission->delete($root);
        	
        	if($res){

        		// 默认返回上一个URL(来源地址)
    	    	$this->success( '删除成功!','',3);

        	}else{

        		$this->error('删除失败!','',3);

        	}

        }else{

            $this -> success( '您无权限删除该角色!','');

        }

    }

}