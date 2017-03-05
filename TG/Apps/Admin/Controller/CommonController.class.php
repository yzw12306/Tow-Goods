<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller 
{
	public function _initialize()
	{
		//判断管理员是否登录
        // if(!session("admin"))
        if(!isset($_SESSION["admin"])){

            //若没有登录就跳转到登录页面
            header("Location:".U("Admin/Login/login"));
            
        }

        //调用模块权限控制函数
        $this->moduleControll();

	}

    public function moduleControll()
    {

      //获得在线管理员的SESSION全局数组里包含的权限root字段的值,
        //这个值等价于权限表permission中字段id的值
        $permission_id = $_SESSION['admin']['root'];

        //实例化权限表permission
        $permission = D("permission");
       
        //根据变量$permission_id来使用数据库函数find(),获取在线管理员的对应权限详细信息。
        $admin_permission = $permission->find($permission_id);

        //获得在线管理员的模块值(即是权限表permission里字段moduleval的值),
        //并赋给变量$admin_permission_moduleval
        $admin_permission_moduleval = $admin_permission['moduleval'] + 0;     

        //获取在线管理员访问各个控制器中的操作的路径，即是请求路径。
        //将其转化成小写(方便操作)，并赋给变量$moduleurl(最后存放的值是控制器名称)
        $moduleurl = strtolower($_SERVER['REQUEST_URI']);
    
        //定义一个变量$needle存放固定标记字符串，用于寻找请求路径中的控制器名称的位置
        $needle = "index.php/admin/";

        //在请求路径字符串中获取固定标记字符串的位置
        $pos = strrpos($moduleurl, $needle);

        //判断标记字符串是否存在
        if($pos){

            //找到标记字符串后，才正式开始获取控制器名称字符串，截取余下的字符串(控制器和操作的字符串)
            $str = substr($moduleurl, $pos + strlen($needle));

            //进一步分离出控制器的字符串
            $temp_arr = explode("/", $str);

            $moduleurl = $temp_arr[0];

            if(empty($moduleurl))
            {

                $moduleurl = "index";

            }
            
            //总算获取了控制器的字符串，并重新赋值给变量$moduleurl，并顺便调用首字母大写函数ucfirst()
            $moduleurl = ucfirst($moduleurl);

            //若请求的是后台首页Index，没有必要对管理员加权限控制(只要成功登陆的管理员都能看到后台首页)
            if($moduleurl != "Index")
            {

                //实例化模块表modules
                $modules = D("modules");
            
                //通过存放控制器名称的变量$moduleurl,在模块表modules中根据字段moduleurl找到对应模块信息
                $url_modules = $modules->where("moduleurl='".$moduleurl."'")->select();
                
                //将请求路径中控制器对应的模块表modules中的模块值moduleval提取出来，赋值给变量data_modules_moduleval
                $url_modules_moduleval = ($url_modules[0]['moduleval'] + 0);

                //在线管理员的模块值$admin_permission_moduleval和请求路径中控制器对应的模块值$url_modules_moduleval进行“位与”运算，运算结果如果是0，则该管理员的模块权限不包含本次请求中的模块
                if(!($admin_permission_moduleval & $url_modules_moduleval))
                {
                    //对该模块没有访问权限，默认操作是跳回后台首页
                    //第一种写法：存在分帧框架跳转的问题
                    // header("Location:".U('Admin/Error/Index'));
                    // 同理第一种
                    // $this->success("抱歉您没有该模块的权限！",U('Admin/Error/Error'));
                    
                    //第二种写法：无法很好控制显示提示信息后再跳转
                
                     exit("<h2>您不具有该操作权限</h2>
                        <script>window.onload = function(){
                            setTimeout(function(){
                                top.location.href=\"../Index/index\";
                           },2000);
                        };</script>");

                     // exit("<script>
                     //        top.location.href=\"../Error/index\";
                     //    </script>");
                  
                }

            }

        }

    }

    // ajax提交管理员信息或角色权限信息,来检测是否对此有权限操作
    public function doCheck(){

        // 接收管理员ID
        $id = I('post.id') + 0;

        // 接受管理员admins表的权限root的值，也可能是接受permission表的id的值
        $root = I('post.root') + 0;

        $has_permission = $this -> rolePermission($root, $id);

        if($has_permission){

            $this -> ajaxReturn(1);

        }else{

            $this -> ajaxReturn(0);

        }
        
    }

     /**
     * [rolePermission 角色权限操作管理函数]  
     * @param  [type] $root [管理员的权限值，也是角色ID]
     * @param  [type] $id   [管理员ID]
     * @return [type]       [能够操作角色权限的情况就返回1，否则返回0]
     */
    protected function rolePermission($root, $id = 0)
    {

        //管理员不能操作自己的角色权限，还有只有超级管理员才能操作其他管理员的角色权限，超级管理员不能被其他管理员操作，
        //若没有第二个参数$id，说明操作的是权限表，即如下第一个判断条件永不成立，可以无视
        if($id == $_SESSION['admin']['id'] || $_SESSION['admin']['root'] != 1 || $root == 1){

            return 0;

        }else{

            return 1;
        }

    }
    
}