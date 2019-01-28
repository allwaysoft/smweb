<?php

namespace Layout\Common;
use Think\Model;
class CheckUserController extends BaseController{
	protected function _initialize(){
		parent::_initialize();
		
		if(session('userid')==false)
		{
			$this->redirect('Login/index');
			exit;
		}
		$user=M('Localuser')->where(array('id'=>$_SESSION['userid']))->find();
		$this->thisUser=$user;
		if($user['user_type'] > 0){   // 0=代理商帐户
			echo "您无权访问此页面内容，请关闭窗口！";
			exit;
		}
			
              //  print_r($user);
              //  echo $_GET['pid'];
               // echo "sss=".$_SESSION['userid'];
		 
	}
}

?>