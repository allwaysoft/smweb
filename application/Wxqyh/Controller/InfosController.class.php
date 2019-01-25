<?php

namespace Home\Controller;

use Common\Common\Controller\UserController;
class InfosController extends UserController{
	public function updateinfo(){
		if (IS_POST) {
			header("Content-type: text/html; charset=utf-8");
			$uid=session('userid');
			$user_name=session('user_name');
			$password=$_POST['newpassword'];
			$db=M('Localuser');
			$db->password=md5(trim($password));
			$isbool=$db->where(array('id'=>$uid,'user_name'=>$user_name))->save();
			if ($isbool) {
				$this->redirect('Main/index',5,'密码修改成功，返回主页，跳转中...');
			}else 
			{
				echo "密码修改失败!<script>setInterval(function(){history.go(-1);},3000);</script>";
			}
		}else 
		{
			if (session('user_type')!=0) {
				$this->redirect(U('Main/index'));
			}
			$this->display();
		}
	}
	public function pwdcheck(){
		$uid=session('userid');
		$user_name=session('user_name');
		$password=$_POST['password'];
		$db=M('Localuser');
		$result=$db->where(array('id'=>$uid,'user_name'=>$user_name))->find();
		if ($result['password']==md5($password)) {
			echo 'true';
		}else 
		{
			echo 'false';
		}
	}
}

?>