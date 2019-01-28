<?php
namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class MainController extends AdminController{
	public function index(){
             
		$this->display();
	}
	public function main(){
		$aid = $_SESSION['uid'];
		$this->aid=$aid;
		$this->display();
	}
	public function top(){
		$this->display();
	}
	public function left(){
		$this->display();
	}
	// 修改密码
	public function pass_ed(){
		if($_POST)
		{
			$db=M('Admin');
			$pwd = $db->where(array('id'=>$_POST['id']))->find();
			$pass = $_POST['opwd'];
			if($pwd['upwd'] != md5($pass)){
				$this->error('原密码不正确，请重新输入');
			}else{
				$data=array(
					'upwd'=>md5($_POST['npwd']),
				);
				$id=$db->where(array('id'=>$_POST['id']))->save($data);
				if($id){
					$this->success('修改成功',U('Admin/Main/main'));
				}else 
				{
					$this->error('修改失败');
				}
			}
		}else{
			$aid = $_SESSION['uid'];
			$this->aid=$aid;
			$this->display();
		}
	}
	// 登出
	public function loginout(){
		$_SESSION = array();
		//unset($_COOKIE);
		if(empty($_SESSION) ){ //&& !isset($_COOKIE['uid']) && !isset($_COOKIE['role_id'])
			
			//setcookie("uid","",time()-3600,"/");
			//setcookie("role_id","",time()-3600,"/");
			$this->success('退出成功',U('/'));//$this->redirect('Admin/Main/index');
		}
	}
	// 查看个人信息
	public function pmess(){
		$id=intval($_GET['id']);
		$table=M('Admin');
		$mess = $table->find($id);
		$this->mess = $mess;
		$role=M('Role')->where('id='.$mess['role_id'])->find();
		$this->role=$role;
		$this->display();
	}
	// 修改个人信息
	public  function pedit(){
		if($_POST)
		{
			$db=M('Admin');
			$data=array(
				'username'=>$_POST['username'],
				'email'=>$_POST['email'],
				'mobile'=>$_POST['mobile']
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Admin/Main/main'));
			}else 
			{
				$this->error('修改失败');
			}
			
		}else{
			$id=intval($_GET['id']);
			$db=M('Admin');
			$admin=$db->find($id);
			$this->admin=$admin;
			$db=M('Role');
			$role=$db->order('id asc')->select();
			$this->role=$role;
			$this->display();
		}
	}
}

?>