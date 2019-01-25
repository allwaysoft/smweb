<?php

namespace Admin\Controller;

use Common\Common\Controller\AdminController;
class LinksController extends AdminController{
	
    public function index(){
        $table=M('Links');
		$where = "";
		if($_GET){
			$where['type_id'] = $_GET['type_id'];
			$this->type_id=$_GET['type_id'];
		}
		$count=$table->where($where)->order('id desc')->count();
		$page=new \Think\Page($count,20);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$show       = $page->show();
		$list=$table->where($where)->order('sort asc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=$list;
		$this->page=$show;
		$this->display();
    }
    public function add(){
        if ($_POST) {
			$db=M('Links');
			$data=array(
					'name'=>$_POST['name'],
					'type_id'=>$_POST['type_id'],
					'image'=>$_POST['image'],
					'url'=>$_POST['url'],
					'isin'=>$_POST['isin'],
					'ispic'=>$_POST['ispic'],
					'sort'=>$_POST['sort'],
					'isarea'=>$_POST['isarea'],
					'display'=>$_POST['display']
			);
			$id=$db->add($data);
			if ($id) {
				$this->success('添加成功',U('Links/index'));
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
			$db=M('Links');
			$data=array(
					'name'=>$_POST['name'],
					'type_id'=>$_POST['type_id'],
					'image'=>$_POST['image'],
					'url'=>$_POST['url'],
					'isin'=>$_POST['isin'],
					'ispic'=>$_POST['ispic'],
					'sort'=>$_POST['sort'],
					'isarea'=>$_POST['isarea'],
					'display'=>$_POST['display'],
			);
			$id=$db->where(array('id'=>$_POST['id']))->save($data);
			if($id){
				$this->success('修改成功',U('Links/index'));
			}else
			{
				$this->error('修改失败');
			}
		}else
		{
			$id=intval($_GET['id']);
			$db=M('Links');
			$infos=$db->find($id);
			$this->infos=$infos;
			$this->display();
		}
    }
	public function del(){
		$id=$_POST['id'];
		$db=M('Links');
		foreach ($id as $val)
		{
			$isbool=$db->delete($val);
		}
		if ($isbool) {
			$this->success('删除成功',U('Links/index'));
		}else {
			$this->error('删除失败');
		}
	}
}

?>