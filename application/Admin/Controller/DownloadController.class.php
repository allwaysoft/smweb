<?php
namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class DownloadController extends AdminController{
	public function index(){
		$this->display();
	}
	// 修改
	public function edit(){
		if (IS_POST) {
			$db=M('Download');
			$urlb = $_POST['urlb'];
			$data['name']    = $_POST['name'];
			$data['url'] =$urlb;
			if (isset($_POST['oListboxTo'])){
				$userida = $_POST['oListboxTo'];
				$userid = implode(',', $userida);
				$data['userid']=$userid;
			}
			$data['description'] = $_POST['description'];
			$isbool=$db->where(array('id'=>$_POST['id']))->save($data);
			if ($isbool) {
				$this->success('修改成功');
			}else 
			{
				$this->error('修改失败');
			}
		}else{
			$db=M('Download');
			$id=$_GET['id'];
			$info=$db->find($id);
			if ($info['type_id']==4) {
				$userid=explode(',', $info['userid']);
				foreach ($userid as $val){
					$user=M('Localuser')->find($val);
					$userlist[]=array('id'=>$user['id'],'user_name'=>$user['user_name']);
				}
				$this->userlist=$userlist;
			}
			$this->info=$info;
			$this->server=explode(',', $info['server']);
			$serverlist = M('Server')->select();
			$this->assign('serverlist',$serverlist);
			$this->display();
		}
		
	}
	// 删除
	public function del(){
		$id=$_GET['id'];
		$db=M('Download');
		if (is_array($id)) {
			$id=implode(',', $id);
		}
			$isbool=$db->delete($id);
		if ($isbool) {
			$this->success('删除成功');
		}else {
			$this->error('删除失败');
		}
	}
	// 删除
	public function viddel(){
		$id=$_POST['id'];
		$db=M('Download');
		foreach ($id as $val)
		{
			$isbool=$db->delete($val);
		}
		if ($isbool) {
			$this->success('删除成功',U('Admin/Download/video'));
		}else {
			$this->error('删除失败');
		}
	}
	// 删除
	public function musdel(){
		$id=$_POST['id'];
		$db=M('Download');
		foreach ($id as $val)
		{
			$isbool=$db->delete($val);
		}
		if ($isbool) {
			$this->success('删除成功',U('Admin/Download/music'));
		}else {
			$this->error('删除失败');
		}
	}
	// 图片下载
	public function picture(){
		$db=M('Download');
		$count=$db->where('type_id = 1 or type_id = 4')->count();
		$page=new \Think\Page($count,15);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show=$page->show();
		$list=$db->where('type_id = 1 or type_id = 4')->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function picadd(){
		if($_POST){
			$db=M('Download');
			//$db->create();
			$urlb = $_POST['urlb'];
			$data['type_id'] = 1;
			$data['name']    = $_POST['name'];
			$data['url'] = $urlb;
			$data['userid'] = 0;
			$data['ispub'] = 1;
			$data['description'] = $_POST['description'];
			$data['addtime'] = empty($_POST['time'])?time():strtotime($_POST['time']);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Admin/Download/picture'));
			}else {
				$this->error('添加失败');
			}
		}else{
			$db = M('Server');
			$serverlist = $db->select();
			$this->assign('serverlist',$serverlist);
			$this->display();
		}
	}
	public function priadd(){
		if($_POST){
			$db=M('Download');
			$urlb = $_POST['urlb'];
			$userida = $_POST['oListboxTo'];
			$userid = implode(',', $userida);
			//echo $userid;
			$data['type_id'] = 4;
			$data['name']    = $_POST['name'];
			$data['url'] = $urlb;
			$data['userid'] = $userid;
			$data['ispub'] = 0;
			$data['description'] = $_POST['description'];
			$data['addtime'] = empty($_POST['time'])?time():strtotime($_POST['time']);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Admin/Download/picture'));
			}else {
				$this->error('添加失败');
			}
		}else{
			$db = M('Server');
			$serverlist = $db->select();
			//print_r($serverlist);
			$this->assign('serverlist',$serverlist);
			$this->display();
		}
	}
	public function search(){
		if($_GET){
			$map['user_name|name'] = array('like',"%".$_GET['search']."%");
			$userlist = M('Localuser')->where($map)->select();
			if(!empty($userlist)){
				foreach($userlist as $k=>$v){
					$msg .= "<option selected='true' value='".$v['id']."'>". $v['user_name'] . "-" . $v['name'] ."</option>";
				}
				echo $msg;
			}else{
				echo "<option>没有找到记录</option>";
			}
		}
	}
	// 视频下载
	public function video(){
		$db=M('Download');
		$count=$db->where('type_id = 2')->count();
		$page=new \Think\Page($count,15);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show=$page->show();
		$list=$db->where('type_id = 2')->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function vidadd(){
		if($_POST){
			$db=M('Download');
			$urlb = $_POST['urlb'];
			$data['type_id'] = 2;
			$data['name']    = $_POST['name'];
			$data['url'] = $urlb;
			$data['userid'] = 0;
			$data['ispub'] = 1;
			$data['description'] = $_POST['description'];
			$data['addtime'] = empty($_POST['time'])?time():strtotime($_POST['time']);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Admin/Download/video'));
			}else {
				$this->error('添加失败');
			}
		}else{
			$db = M('Server');
			$serverlist = $db->select();
			$this->assign('serverlist',$serverlist);
			$this->display();
		}
	}
	// 音乐下载
	public function music(){
		$db=M('Download');
		$count=$db->where('type_id = 3')->count();
		$page=new \Think\Page($count,15);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show=$page->show();
		$list=$db->where('type_id = 3')->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function musadd(){
		if($_POST){
			$db=M('Download');
			$urlb = $_POST['urlb'];
			$data['type_id'] = 3;
			$data['name']    = $_POST['name'];
			$data['url'] = $urlb;
			$data['userid'] = 0;
			$data['ispub'] = 1;
			$data['description'] = $_POST['description'];
			$data['addtime'] = empty($_POST['time'])?time():strtotime($_POST['time']);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Admin/Download/music'));
			}else {
				$this->error('添加失败');
			}
		}else{
			$db = M('Server');
			$serverlist = $db->select();
			$this->assign('serverlist',$serverlist);
			$this->display();
		}
	}
	// 服务器管理
	public function server(){
		$db=M('Server');
		$count=$db->count();
		$page=new \Think\Page($count,15);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show=$page->show();
		$list=$db->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function seradd(){
		if($_POST){
			$db=M('Server');
			$isset=$db->where(array('name'=>$_POST['name']))->find();
			if($isset){
				$this->error('该服务器名已存在');
			}else 
			{
				$db->create();
				$id=$db->add();
				if ($id) {
					$this->success('添加成功',U('Admin/Download/server'));
				}else 
				{
					$this->error('添加失败');
				}
			}
		}else{
			
			$this->display();
		}
	}
	public function seredit(){
		if ($_POST) {
			$db=M('Server');
			$data=array(
					'name'=>$_POST['name'],
					'url'=>$_POST['url']
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Download/server'));
			}else
			{
				$this->error('修改失败');
			}
		}else
		{
			$id=intval($_GET['id']);
			$db=M('Server');
			$infos=$db->find($id);
			$this->infos=$infos;
			$this->display();
		}
	}
	public function serdel(){
		$id=$_POST['id'];
		$db=M('Server');
		foreach ($id as $val)
		{
			$isbool=$db->delete($val);
		}
		if ($isbool) {
			$this->success('删除成功',U('Admin/Download/server'));
		}else {
			$this->error('删除失败');
		}
	}
}

?>