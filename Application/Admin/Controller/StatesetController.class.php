<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class StatesetController extends AdminController{
	public function index(){
		$this->display();
	}
	public function insert(){
		$file=$_POST['files'];
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
		if ($this->update_config($_POST,CONF_PATH.$file)) {
			$this->success('修改成功');
		}else
		{
			$this->error('修改失败');
		}
	}
	public function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'web.php';
		if (is_writable($config_file)) {
			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}
}

?>