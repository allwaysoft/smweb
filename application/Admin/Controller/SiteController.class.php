<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class SiteController extends AdminController{
	public function index(){
		$this->display();
	}
	public function email(){
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
	public function sendTest(){
		$toMail=$_GET['toEmail'];
		$server=$_GET['email_server'];
		$port=$_GET['email_port'];
		$email_user=$_GET['email_user'];
		$email_pwd=$_GET['email_pwd'];
		$subject='网站系统邮件测试';
		$body='<p>当您收到这封邮件时，说明邮件配置已经正确。</p>';
		if($this->sendEmail($toMail, $server, $port, $email_user, $email_pwd, $subject, $body)){
			echo '1';
		}else{
			echo '0';
		}
	}
	private function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'web.php';
		if (is_writable($config_file)) {
			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}
	public function sendEmail($toMail,$type,$server,$port,$email_user,$email_pwd,$subject,$body){
		vendor('PHPMailer.class#phpmailer');
		$server=$server==null?C('email_server'):$server;
		$port=$port==null?C('email_port'):$port;
		$email_user=$email_user==null?C('email_user'):$email_user;
		$email_pwd=$email_pwd==null?C('email_pwd'):$email_pwd;
		$subject=$subject==null?C('email_title'):$subject;
		$body=$body==null?C('email_content'):$body;
		switch ($type){
			case 0:
				$body=str_replace('$password', C('reception_pwd'), $body);
			case 1:
				$body=str_replace('$password', C('backstage_pwd'), $body);
			default:
				$body==$body;
		}
		$mail=new \PHPMailer();
		$mail->IsSMTP();    // 启用SMTP
		$mail->Host = $server;           //SMTP服务器
		$mail->SMTPAuth = true;                  //开启SMTP认证
		$mail->Username = $email_user;            // SMTP用户名
		$mail->Password = $email_pwd;                // SMTP密码
		$mail->Port = $port;
		$mail->From = $email_user;            //发件人地址
		$mail->FromName = '网站系统管理员';              //发件人
		$mail->AddAddress($toMail); //添加收件人
		$mail->IsHTML(true);                 // 是否HTML格式邮件
		$mail->CharSet = "utf-8";
		$mail->Encoding = "base64";
		$mail->Subject = $subject;          //邮件主题
		$mail->Body    = $body;        //邮件内容
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //邮件正文不支持HTML的备用显示
		if ($mail->Send()) {
			return true;
		}else 
		{
			return false;
		}
	}
}

?>