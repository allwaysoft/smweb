<?php

namespace Wxqyh\Common;

use Think\Model;
class UserController extends BaseController{
	protected function _initialize(){
		parent::_initialize();
		$user=M('Localuser')->where(array('id'=>$_SESSION['userid']))->find();
		$this->thisUser=$user;
		if(session('userid')==false)
		{
                   // echo "sdf";
                    //$this->redirect('Wxqyh/Index/index');
		}
		 
		 
	}
}

?>