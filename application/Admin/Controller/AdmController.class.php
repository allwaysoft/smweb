<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class AdmController extends AdminController{
	public function admindex(){
		
		$table=M('Admin');
		$where='pid=0';
		if (session('role_id')!=1) {
			$where.=' and role_id !=1 ';
		}
		$keyword=@$_GET['keyword']!=''?$_GET['keyword']:'';
		$where.=@$_GET['keyword']!=''?"and user_id like '%".$_GET['keyword']."%' or username like '%".$_GET['keyword']."%'":'';
		$this->keyword=$keyword;
		$count=$table->where($where)->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$table->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$value)
		{
			$role=M('Role')->where(array('id'=>$value['role_id']))->find();
			$list[$key]['role_name']=$role['name'];
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function admadd(){
		//角色
		if($_POST)
		{
			$db=M('Admin');
			$isset=$db->where(array('user_id'=>$_POST['user_id']))->find();
			if($isset)
			{
				$this->error('此账户名已存在');
			}else 
			{
				$data=array(
					'user_id'=>$_POST['user_id'],
					'upwd'=>md5($_POST['upwd']),
					'username'=>$_POST['username'],
					'email'=>$_POST['email'],
					'mobile'=>$_POST['mobile'],
					'role_id'=>$_POST['role_id'],
					'state_id'=>$_POST['state_id'],
					'create_time'=>time()
				);
				$id=$db->add($data);
				if($id){
					$this->success('添加成功',U('Admin/Adm/admindex'));
				}
			}
		}else 
		{
			$db=M('Role');
			$role=$db->where(array('is_sys'=>0,'id'=>array('neq','1')))->order('id asc')->select();
			$this->role=$role;
			$this->display();
		}
		
	}
	public  function admedit(){
		if($_POST)
		{
		$db=M('Admin');
			 
				$data=array(
					'user_id'=>$_POST['user_id'],
					'username'=>$_POST['username'],
					'email'=>$_POST['email'],
					'mobile'=>$_POST['mobile'],
					'role_id'=>$_POST['role_id'],
					'state_id'=>$_POST['state_id']
				);
				$id=$db->where(array('id'=>$_POST['id']))->save($data);
				if($id){
					$this->success('修改成功',U('Admin/Adm/admindex'));
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
			$role=$db->where(array('is_sys'=>0,'id'=>array('neq','1')))->order('id asc')->select();
			$this->role=$role;
			$this->display();
		}
	}
	public function resetPwd(){
		$id=$_GET['id'];
		$db=M('Admin');
		$tuser=$db->find($id);
		$db->id=$id;
		$db->upwd=md5(C('backstage_pwd'));
		$isbool=$db->save();
		if ($isbool) {
			if (C('send_mail')) {
				$mail=A('Site');
				$mail->sendEmail($tuser['email'],1);
			}
			die('1');
		}else
		{
			die('0');
		}
	}
	public function admdel(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Admin');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功',U('Adm/admindex'));
		}else
		{
			$this->error('删除失败');
		}
	}
	public function logs(){
		$db=M('Admin_loginlogs');
		$count=$db->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$val){
			$id=$val['user_id'];
			$local=M('Admin')->field('username')->find($id);
			$list[$key]['uname']=$local['username'];
			$ipInfos = $this->getIPLoc_sina($val['ip']);
			$list[$key]['ip_add']=$ipInfos->country.'-'.$ipInfos->province.'-'.$ipInfos->city;
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	function getIPLoc_sina($queryIP){    
		$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;    
		$ch = curl_init($url);     
		curl_setopt($ch,CURLOPT_ENCODING ,'utf8');     
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);   
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		$location = curl_exec($ch);    
		$location = json_decode($location);    
		curl_close($ch);         
		return $location;
	}
}
?>