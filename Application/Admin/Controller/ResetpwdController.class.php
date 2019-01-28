<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class ResetpwdController extends AdminController{
	public function index(){
		$this->send_mail=C('send_mail');
		$this->display();
	}
	public function insert(){
		$file=$_POST['files'];
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
		$update=A('Stateset');
		if($update->update_config($_POST,CONF_PATH.$file)){
			$this->success('更新成功');
		}else{
			$this->error('更新失败');
		}
	}
}

?>