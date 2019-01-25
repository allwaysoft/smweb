<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){ 
		if(isset($_COOKIE['uid']) && isset($_COOKIE['role_id'])){
			$this->redirect('Admin/Main/index');
		}
    	$this->display();
    }
    public function checklogin(){
    	$userid=$_POST['userid'];
    	$password=$_POST['password'];
    	$validCode=$_POST['validCode'];
    	//$ip = get_client_ip(); // thinkphp 获取ip地址
        $ip = $_SERVER["HTTP_CDN_SRC_IP"]; // cdn加速后获取的真实IP地址
		$time = time();
		$admin=M('Admin')->where(array('user_id'=>$userid))->find();
		// 验证码不正确
		$logs=M('Admin_loginlogs');
		$logs->user_id=$admin['id'];
		$logs->time=$time;
		$logs->ip=$ip;
		$verify=new \Think\Verify();
		if($verify->check($validCode)==false)
		{
			$logs->contents='验证码不正确！';
			$logs->add();
			die('1');
		}
		if(!$admin){
			$logs->contents='账号'.$userid.'不存在！';
			$logs->add();
			die('4');
		}
		elseif($admin['state_id']!=1){
			$logs->contents='账号'.$userid.'被锁定！';
			$logs->add();
			die('2');
		}
		elseif($admin['upwd']!=md5($password)){
			$logs->contents='账号'.$userid.'密码不正确！';
			$logs->add();
			die('3');
		}else 
		{
			$logs->contents='账号'.$userid.'登录成功！';
			$logs->add();
			M('Admin')->where(array('user_id'=>$userid))->save(array('last_time'=>$time));
			session('uid',$admin['id']);
			session('username',$admin['username']);
			session('role_id',$admin['role_id']);
			session('pid',$admin['pid']);
//			if($_POST['check']=1){
//				setcookie("uid", $admin['id'], time()+3600*24*10,"/");
//				setcookie("role_id", $admin['role_id'], time()+3600*24*10,"/");
//			}
			die('0');
		}
    	
    }

	public function verify()
	{
		$config=array(
				'fontSize'  =>	'30',
				'length'	=>	'4',
				'useImgBg'  =>	false,
				'useCurve'	=>	false,
				'useNoise'	=>	false,
				'bg'		=>	array(243, 251, 254),
		);
		$Verify=new \Think\Verify($config);
		$Verify->entry();
	}
}