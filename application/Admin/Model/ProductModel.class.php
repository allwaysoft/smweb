<?php

namespace Admin\Model;

use Think\Model;
class ProductModel extends Model{
	protected $_auto=array(
		array('time','getTime',1,'callback'),
		array('colorcode','newColor',3,'callback'),
		array('rule','newRule',3,'callback')
	);
	function getTime(){
		return time();
	}
	function newColor(){
		return str_replace('-', ',', $_POST['colorcode']);
	}function newRule(){
		return str_replace('-', ',', $_POST['rule']);
	}
	
}

?>