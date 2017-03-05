<?php 
namespace Home\Model;
use Think\Model;

class EvaluateModel extends Model
{

	protected $_validate = [

		['score','require','请选择评分'],

		['orderid','','不能给同一订单重复评分！',0,'unique',1],

	];

}