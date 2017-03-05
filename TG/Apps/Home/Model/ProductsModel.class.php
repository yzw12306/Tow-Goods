<?php 
namespace Home\Model;
use Think\Model;

class ProductsModel extends Model
{

	protected $_validate = [

            ['goods' , 'require' , '商品名称不能为空'],

            ['company' , 'require' , '生产厂家不能为空'],

            ['description' , 'require' , '商品描述不能为空'],

            ['initprice' , 'require' , '商品原价不能为空'],

            ['price' , 'require' , '商品单价不能为空'],

            ['typeid' , 'require' , '请选择商品类别'],

            ['fineness' , 'require' , '请选择商品成色'],

            ['trade' , 'require' , '请选择交易方式'],

            ['deliver' , 'require' , '请选择送货方式'],

            ['initprice' , '1,999999' , '商品原价不能为负数' , 1 , 'length' , 3],
            
            ['price' , '1,999999' , '商品原价不能负数' , 1 , 'length' , 3],

        ];

	public function pro_index()
	{

		//点击首页分类导航栏里传来的分类ID
		$id = I("get.id") + 0;

		$clicknum = (I("get.clicknum") !== null) ? I("get.clicknum") : "";

		$price = (I("get.price") !== null) ? I("get.price") : "";	

		$price1 = I("get.price1") + 0;

		$price2 = I("get.price2") + 0;

        $search = I("get.search");

        $map = [];

        $typeid_str = "";

        $type = D('type');

        //商品分类检索
        if($id){    	

        	$result_id = $type -> find($id);

        	//id的分类父pid为0
        	if(!$result_id['pid']){   

        		//此时$id的值属于一级分类 显示在分类条件选中栏(最前面默认会有："全部"字样，后面会接例如：闲置数码，书籍资料，户外运动等等中的一种)
        		$data_typepid[] = ['id' => $result_id['id'], 'name' => $result_id['name']];

        		// 二级分类的搜索在分类表type里模糊检索包含该id的路径path的分类信息
	        	$map_typeid_two['path'] = ['like', '%,'.$id.','];

	        	$result_type_two = $type -> where($map_typeid_two) -> select();

	        	foreach ($result_type_two as $key => $value) {

                    $sum = $this -> sum_class($type, 'pid = '.$value['id']);             
	        		
	        		//二级分类 显示在分类条件筛选栏(例如选中栏里放的是闲置数码，这里就放的是他的子类：手机、电脑等等多个分类)
	        		$data_type[] = ['id' => $value['id'], 'name' => $value['name'], 'sum' => $sum];

	        	}
                // exit;

        		// 三级分类的搜索在分类表type里模糊检索包含该id的路径path的分类信息
	        	$map_typeid_three['path'] = ['like', '%,'.$id.',%,'];
	        	
	        	//三级分类 会被拼接成SQL语句中关键字in条件里typeid值的集合，最终搜索出对应的商品
	        	$result_type_three = $type -> where($map_typeid_three) -> select();

	        	foreach ($result_type_three as $key => $value) {

	        		$typeid_str .= $value['id'].',';

	        	}

        	}else{   		

        		$result_pid = $type -> find($result_id['pid']);

        		if(!$result_pid['pid']){

        			//此时$id的值属于二级分类
	        		$data_typepid[] = ['id' => $result_pid['id'], 'name' => $result_pid['name']];

	        		$data_typepid[] = ['id' => $result_id['id'], 'name' => $result_id['name']];

	        		// 二级分类的搜索在分类表type里模糊检索包含该id的路径path的分类信息
		        	$map_typeid_two['path'] = ['like', '%,%,'.$id.','];

		        	$result_type_two = $type -> where($map_typeid_two) -> select();

		        	foreach ($result_type_two as $key => $value) {

                        $sum = $this -> where('typeid = '.$value['id']) -> count();
		        		
		        		$data_type[] = ['id' => $value['id'], 'name' => $value['name'], 'sum' => $sum];

		        		$typeid_str .= $value['id'].',';

		        	}

	        	}else{

	        		$result_ppid = $type -> find($result_pid['pid']);

	        		//此时$id的值属于三级分类
	        		$data_typepid[] = ['id' => $result_ppid['id'], 'name' => $result_ppid['name']];

	        		$data_typepid[] = ['id' => $result_pid['id'], 'name' => $result_pid['name']];

	        		$data_typepid[] = ['id' => $result_id['id'], 'name' => $result_id['name']];

        			$typeid_str = $id.",";

	        	}

        	}

            //剔除多个typeid连接字符串中的最后一个逗号
        	$typeid_str = rtrim($typeid_str, ",");

        	//加入到SQL条件查询语句中去
        	$map['typeid'] = ['in', $typeid_str];


        }else{

        	//此时$id的值属于顶级分类，所以要对其下的一级分类进行搜索，
        	//在分类表type里找到pid为0的分类信息
        	$map_typeid_one['pid'] = ['eq', 0];

        	$result_type_one = $type -> where($map_typeid_one) -> select();

        	foreach ($result_type_one as $key => $value) {

                $sum = $this -> sum_class($type, ['path' => ['like', "%,".$value['id'].",%"]]);
        		
        		$data_type[] = ['id' => $value['id'], 'name' => $value['name'], 'sum' => $sum];

        	}

        	//检索商品条件：全部商品
        	$map[] = "1=1";

        }

        if($search){

        	$map['goods|company'] = ['like', "%".$search."%"]; 

        }     
      
        //商品筛选条件判断
        if($price2 >= $price1 && ($price1 > 0 || $price2 > 0)){

        	$map['price'] = [['gt', $price1], ['lt', $price2], "AND"];

        	$price1 = number_format($price1, 2);

        	$price2 = number_format($price2, 2);

        }else{

            //清空价格
        	$price1 = "";

        	$price2 = "";

        }

        // 得到总行数
        $totalRow = $this -> where($map) -> count();

        // 每页显示条数
        $num = 50;

        // 实例化分页类
        $page = new \Think\Page($totalRow , $num);

        $order = "";

        //商品排序条件判断
        if($price){

            $order = 'price '.$price;
            
    	}else if($clicknum){

            $order = 'clicknum '.$clicknum;             

        }else{
        
            $order = 'addtime desc';    

        }  

        $newcollect = [];

        $newmessage = [];

        //用户登录才会遍历收藏的商品
        if($_SESSION['users']){

            $collection = $this -> table('tg.tg_collection') -> field('productid') -> where('userid = '. $_SESSION['users']['id']) -> select();

            //将从收藏表collection里遍历出来的二维数组，转换成仅存放了用户收藏的商品id的一维索引数组
            foreach ($collection as $key => $value) {

               $newcollect[] = $value['productid'];

            }
        }

         //从留言表messages里遍历出来proudctid对应总数的二维数组，
        $messages = $this -> table('tg.tg_messages') -> field('productid, count(*) as sum') -> group('productid') -> select();

        //将上面遍历出来的二维数组，转换成以productid为键以sum为值的一维索引数组
        foreach ($messages as $key => $value) {

            $newmessage[$value['productid']] = $value['sum'];

        }

        // dump($messages);
        // dump($newmessage);
        // exit;

        $list = $this -> where($map) -> order($order) -> limit( $page->firstRow . ',' . $page->listRows ) -> select();            

        $fineness = ['非全新', '全新'];

        $status = [1 => '在售', 2 => '下架'];

        $trade = [1 => '不可讲价', 2 => '拍卖'];

        $deliver = [1 => '快递', 2 => '面交'];

        // 处理成正确的显示数据
        foreach($list as $key => &$val){     

			$val['finenessname'] = $fineness[ $val['fineness'] + 0 ];   

			$val['statusname'] = $status[ $val['status'] + 0 ];

			$val['tradename'] = $trade[ $val['trade'] + 0 ];

			$val['delivername'] = $deliver[ $val['deliver'] + 0 ];

			$val['addtime'] = date('Y-m-d H:i:s',$val['addtime']);

            if( in_array ( $val['id'], $newcollect ) ){

                $val['collected'] = true;

            }else{

                $val['collected'] = false;

            }

            if( array_key_exists( $val['id'], $newmessage) ){

                $val['messagenum'] = $newmessage[$val['id']];

            }else{

                $val['messagenum'] = 0;

            }
            
        }

        return [

        	'id' => $id,

        	//分类条件选中栏的数据
        	'typepid' => $data_typepid,

        	//分类条件筛选栏的数据
        	'type' => $data_type,

        	//最低价格
        	'price1' => $price1,

        	//最高价格
        	'price2' => $price2,

        	//搜索结果值
        	'search' => $search,

			// 商品列表
			'list' => $list,

			// 分页按钮
			'show' => $page -> show()

        ];   

	}

    //商品分类的总计数
    private function sum_class($type, $where)
    {

        $result = $type ->field('id') -> where($where) -> select();

        //循坏一次，就清空一次
        $typeid_str = "";

        foreach ($result as $key => $val) {

            $typeid_str .= $val['id'].',';
            
        }

        $map['typeid'] = ['in', $typeid_str];

        $sum = $this -> where($map) -> count();

        return $sum;

    }

	public function upload()
    {

        $upload = new \Think\Upload();// 实例化上传类
        
        $upload->maxSize = 3145728 ;// 设置附件上传大小
        
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        
        $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录

        // 设置是否自动使用子目录保存上传文件
        $upload ->autoSub = false;
        
        $upload->savePath = ''; // 设置附件上传（子）目录
        
        // 上传文件
        $info = $upload->upload();

        if($info){

             return $info;

        }else{

            return $upload->getError();

        }

    }

    public function my_products()
    {

        $map['userid'] = ['eq',$_SESSION['users']['id']];

        $count = $this->where($map)->count();

        $page = new \Think\Page($count,5);

        $list = $this->where($map)->limit($page->firstRow.','.$page->listRows)->select();

        $status = [1=>'在售',2=>'下架',3=>'失效'];

        foreach($list as $key=>&$val){

            $val['status'] = $status[$val['status']];
            
            $val['addtime'] = date('Y-m-d H:i',$val['addtime']);

        }

        return [

        'list'=>$list,

        'show'=>$page->show()

        ];            
        
    }

    public function do_details()
    {
        $id = I('get.id')+0;

        // 通过id查找商品信息
        $list = $this -> find($id);

        // 计算点击量
        $clicknum = $list['clicknum'] + 1;

        $click['clicknum'] = $clicknum;

        $map['id'] = $id;

        // 更新数据库的点击量
        $this -> where($map) -> save($click);

        // 处理商品数据
        $trade = [1 => '该商品可以讲价' , 2 => "该商品拒绝讲价"];

        $fineness = [0 => '非全新' , 1 => "全新"];

        $deliver = [1 => '在线交易' , 2 => '面交'];

        $list['trade'] = $trade[$list['trade']];

        $list['fineness'] = $fineness[$list['fineness']];

        $list['deliver'] = $deliver[$list['deliver']];

        $list['addtime'] = date('Y-m-d H:i:s',$list['addtime']);

        return $list;

    }

}