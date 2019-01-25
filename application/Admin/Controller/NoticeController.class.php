<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class NoticeController extends AdminController{
	public function index(){
		$table=M('Notice');
		$keyword=@$_POST['keyword']!=''?$_POST['keyword']:'';
		$where=@$_POST['keyword']!=''?"a.user_id like '%".$_POST['keyword']."%' or a.username like '%".$_POST['keyword']."%'":'';
		$this->keyword=$keyword;
		$count=$table->where($where)->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prve', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$table->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
	}
	public function add(){
		if ($_POST) {
			$db=M('Notice');
			$time=$_POST['time'];
			$time=explode('/',$time);
			$time=mktime(0,0,0,$time[1],$time[2],$time[0]);
			$data=array(
				'title'=>$_POST['title'],
				'time'=>$time,
				'sort'=>$_POST['sort'],
				'keyword'=>$_POST['keyword'],
				'description'	=>$_POST['description'],
				'contents'=>$_POST['contents']
			);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Notice/index'));
			}else 
			{
				$this->error('添加失败');
			}
		}else{
			$this->display();
		}
	}
	public function edit(){
		if ($_POST) {
			$db=M('Notice');
			$data=array(
					'title'=>$_POST['title'],
				'time'=>$time,
				'sort'=>$_POST['sort'],
				'keyword'=>$_POST['keyword'],
				'description'	=>$_POST['description'],
				'contents'=>$_POST['contents']
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Notice/index'));
			}else
			{
				$this->error('修改失败');
			}
		}else 
		{
			$id=intval($_GET['id']);
			$db=M('Notice');
			$infos=$db->find($id);
			$this->infos=$infos;
			$this->display();
		}
	}
	public function del(){
		$db=M('Notice');
		$id=$db->delete($_GET['id']);
		if ($id) {
			$this->success('删除成功',U('Notice/index'));
		}else {
			$this->error('删除失败');
		}
	}
}

?>