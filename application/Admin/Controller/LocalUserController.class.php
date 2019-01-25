<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class LocalUserController extends AdminController{
	public function LocalUserindex(){
		$db=M('Localuser');
		$where['user_type']=0;
		$keyword = @$_GET['keyword'];
		$this->keyword = $keyword;
		if ($keyword!='') {
			$where['_string']='(user_name like "%'.$keyword.'%")OR(name like "%'.$keyword.'%")';
		}
		$condition=@$_GET['condition'];
		$this->condition=$condition;
		switch ($condition){
			case 'L_active':
				$where['login_state']=0;
				break;
			case 'L_free':
				$where['login_state']=1;
				break;
			case 'L_lock':
				$where['login_state']=2;
				break;
			case 'S_open':
				$where['states']=0;
				break;
			case 'S_lock':
				$where['states']=1;
				break;
		}
		$count=$db->where($where)->order('create_time desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$db->where($where)->order('create_time desc')->limit($page->firstRow.','.$page->listRows)->select();
		foreach ($list as $key=>$val){
			$log_ip=M('Local_loginlogs')->field('state')->where(array('uid'=>$val['id']))->order('id desc')->limit(50)->select();
			$state=array();
			foreach ($log_ip as $v){
				$state[]=$v['state'];
			}
			if (in_array(1, $state)||in_array(2, $state)||in_array(3, $state)) {
				$list[$key]['qure']=1;
			}else{
				$list[$key]['qure']=0;
			}
			
		}
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function resetPwd(){
		$id=$_GET['id'];
		$db=M('Localuser');
		$tuser=$db->find($id);
		$db->id=$id;
		$db->password=C('reception_pwd');//md5();
		$db->modifytime=time();
		$isbool=$db->save();
		if ($isbool) {
			if (C('send_mail')) {
				$mail=A('Site');
				$mail->sendEmail($tuser['email'],0);
			}
			die('1');
		}else 
		{
			die('0');
		}
	}
	public function LocalUserimport(){
		if ($_POST) {
			header("Content-type: text/html; charset=utf-8");
			vendor('PHPExcel.PHPExcel');
			$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
			$cacheSettings = array();
			\PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
			$objPHPExcel = new \PHPExcel();
			$objPHPExcel = \PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
			$indata = $objPHPExcel->getSheet(0)->toArray();
			unset($indata[0]);
			unset($indata[1]);
			$db=M('Localuser');
			$str="";
			$i=0;
			foreach ($indata as $arr)
			{
				$is_find=M('Localuser')->where(array('user_name'=>$arr[0]))->find();
				if (!$is_find) {
					$db->user_name=trim($arr[0]);
					$db->password=trim($arr[1])!=''?md5(trim($arr[1])):'';
					$db->name=trim($arr[2]);
					$db->phone=trim($arr[3]);
					$db->email=trim($arr[4]);
					$db->deptname=trim($arr[5]);
					$db->province=trim($arr[6]);
					$db->city=trim($arr[7]);
					$db->area1=trim($arr[8]);
					$db->area2=trim($arr[9]);
					$db->create_time=time();
					$db->add();	
				}else
				{
					$i++;
					$str.=$i.'.'.$arr[0].'<br/>';
				}
			}
			if ($str=='') {
				$this->success('导入成功',U('LocalUser/LocalUserindex'));
			}else{
				echo "重命名用户：重复用户名记录：".$i."条,<a href='javascript:history.go(-1);'>返回</a><br/>".$str;
			}
			
		}else
		{
			
			$this->display();
		}
	}
	public function LocalUseradd(){
		if ($_POST) {
			$db=M('Localuser');
			$find=$db->where(array('user_name'=>$_POST['user_name']))->find();
			if($find)
			{
				$this->error('该用户名已存在');
			}else 
			{
				$data['user_name']=$_POST['user_name'];
				$data['password']=md5($_POST['password']);
				$data['name']=$_POST['name'];
				$data['deptname']=$_POST['deptname'];
				$data['province']=$_POST['province'];
				$data['city']=$_POST['city'];
				$data['area1']=$_POST['area1'];
				$data['area2']=$_POST['area2'];
				$data['email']=$_POST['email'];
				$data['phone']=$_POST['phone'];
				$data['states']=$_POST['states'];
				$data['create_time']=time();
				$id=$db->add($data);
				if ($id) {
					$this->success('添加成功',U('LocalUser/LocalUserindex'));
				}else
				{
					$this->error('添加失败');
				}
			}
			
		}else 
		{
			$this->display();
		}
	}
	public function LocalUseredit(){
		if ($_POST) {
			$db=M('Localuser');
			$data=array(
					'user_name'=>$_POST['user_name'],
						'name'=>$_POST['name'],
						'deptname'=>$_POST['deptname'],
						'province'=>$_POST['province'],
						'city'=>$_POST['city'],
						'area1'=>$_POST['area1'],
						'area2'=>$_POST['area2'],
					'email'=>$_POST['email'],
					'phone'=>$_POST['phone'],
					'states'=>$_POST['states'],
					'modifytime'=>time()
				);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('LocalUser/LocalUserindex'));
			}else
			{
				$this->error('修改失败');
			}
		}else {
			$id=intval($_GET['id']);
			$db=M('Localuser');
			$user=$db->find($id);
			$this->user=$user;
			$this->display();
		}
	}
	public function LocalUserdel(){
		if ($_GET)
		{
			$id=I('get.id',0,'intval');
		}elseif ($_POST){
			$id=implode(',', $_POST['id']);
		}
		$db=M('Localuser');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else 
		{
			$this->error('删除失败');
		}
	}
	public function logs(){
		$where="b.id=a.uid and b.user_type=0";
		if($_GET['id'])
		{
			$uid = I('get.id',0,'intval');
			$where.=" and a.uid=$uid";
		}
		$keyword=@$_GET['keyword']!=''?$_GET['keyword']:'';
		$this->keyword=$keyword;
		$where.=@$_GET['keyword']!=''?' and b.user_name LIKE "%'.$keyword.'%"':'';
		$db=M('Local_loginlogs');
		$count=M()->table(array('tp_local_loginlogs' => 'a', 'tp_localuser' => 'b'))->where($where)->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=M()->table(array('tp_local_loginlogs' => 'a', 'tp_localuser' => 'b'))->field('b.user_name as uname,a.*')->where($where)->limit($page->firstRow.','.$page->listRows)->order('time desc')->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function logsdel(){
		$id=implode(',', $_POST['id']);
		$db=M('Local_loginlogs');
		$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else
		{
			$this->error('删除失败');
		}
	}
	public function Getinfo(){
		$id=$_POST['id'];
		$db=M('Localuser');
		$info=$db->find($id);
		echo $info['user_name'];
	}
	public function ChangeLoginState(){
		$id=$_POST['id'];
		$db=M('Localuser');
		$db->id=$id;
		$db->last_time=time();
		$db->login_state=0;
		$isbool=$db->save();
		if ($isbool) {
			echo '1';
		}else 
		{
			echo '0';
		}
	}
}

?>